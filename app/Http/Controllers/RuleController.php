<?php

namespace App\Http\Controllers;

use App\artwork;
use App\rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use MarkWilson\VerbalExpression;

class RuleController extends Controller
{
    public function index()
    {

        if (!Auth::check())
            return redirect()->intended('login');
        $rules = rule::all();
        return view('rules.rules_view', ['rules' => $rules]);
    }

    public function destroy($id)
    {
        if (!Auth::check())
            return redirect()->intended('login');
        rule::destroy($id);
        return redirect('rule');
    }


    public function store(Request $request)
    {
        $regex = new VerbalExpression();
        $rule = new rule();
        $rule->label = $request->ruleName;
        $attribute = $request->attribute0;
        $constraint = $request->constraint0;
        $value = $request->value0;
        $results = array();

        switch ($constraint) {
            case "contains":
                $rule->rule_type = 'text';
                $regex->find($value);
                $results = artwork::whereRaw($attribute . ' ~ ' . '\'' . $regex->compile() . '\'')->get();
                $rule->regexp = $regex->compile();

                break;
            case "notcontains":
                $rule->rule_type = 'text';

                $regex->anything()
                    ->anythingBut($value)
                    ->anything();
                $results = artwork::whereRaw($attribute . ' ~ ' . '\'' . $regex->compile() . '\'')->get();
                $rule->regexp = $regex->compile();

                break;
            case "begins":
                $rule->rule_type = 'text';

                $regex->startOfLine()
                    ->then($value);
                $results = artwork::whereRaw($attribute . ' ~ ' . '\'' . $regex->compile() . '\'')->get();
                $rule->regexp = $regex->compile();

                break;
            case "ends":
                $rule->rule_type = 'text';

                $regex->endOfLine()
                    ->add($value);
                $results = artwork::whereRaw($attribute . ' ~ ' . '\'' . $regex->compile() . '\'')->get();
                $rule->regexp = $regex->compile();

                break;


            case "between":
                $rule->rule_type = 'number';

                $results = artwork::whereRaw($attribute . ' BETWEEN ' . $value . ' AND ' . $request->value_greater)->get();
                $rule->regexp = "between " . $value . " " . $request->value_greater;
                break;
            case "morethan":
                $rule->rule_type = 'number';

                $results = artwork::whereRaw($attribute . ' > ' . $value)->get();
                $rule->regexp = "morethan " . $value;
                break;
            case "lessthan":
                $rule->rule_type = 'number';

                $results = artwork::whereRaw($attribute . ' < ' . $value)->get();
                $rule->regexp = "lessthan " . $value;

                break;
            case "equalto":
                $rule->rule_type = 'number';

                $results = artwork::whereRaw($attribute . ' = ' . $value)->get();
                $rule->regexp = "equalto " . $value;

                break;

            default:
                echo $constraint;

        }

        $rule->attribute = $attribute;

        $rule->save();
        $attributes = Schema::getColumnListing("artworks");
        return view('rules.rules_create', ['results' => $results, 'attributes' => $attributes]);
    }

    public function ruleMaker()
    {
        if (!Auth::check())
            return redirect()->intended('login');


        $attributes = Schema::getColumnListing("artworks");


        return view('rules.rules_create', ['attributes' => $attributes]);

    }

}

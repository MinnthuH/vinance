<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function list()
    {
        $pageTitle  = "Market List";
        $markets    = Market::with('currency')->searchable(['name', 'currency:name,symbol'])->orderBy('name', 'ASC')->paginate(getPaginate());
        return view('admin.market.list', compact('pageTitle', 'markets'));
    }

    public function save(Request $request, $id = 0)
    {
        $request->validate([
            'name'     => "required|max:255|unique:markets,name,$id",
            'currency' => "required|integer",
        ]);

        $currency = Currency::active()->where('id', $request->currency)->first();
        if (!$currency) return returnBack("Currency not found");

        $hasAnotherMarketWithCurrency = Market::where('id', '!=', $id)->where('currency_id', $currency->id)->exists();
        if ($hasAnotherMarketWithCurrency) return returnBack("Can't create one more market with the same currency.");

        if ($id) {
            $market  = Market::findOrFail($id);
            $message = "Market updated successfully";
        } else {
            $market              = new Market();
            $message             = "Market added successfully";
            $market->currency_id = $request->currency;
        }

        $market->name        = $request->name;
        $market->save();
        
        return returnBack($message,'success');
    }
    public function status($id)
    {
        return Market::changeStatus($id);
    }
}

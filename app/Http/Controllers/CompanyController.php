<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'image',
            'website' => 'url|max:255'
        ]);
        $company = new Company();

        $company->name = $request->name;
        $company->slug = Str::slug($company->name);

        $company->email = $request->email;
        if ($request->file('logo')) 
        {

            $logo_name = Str::slug($request->file('logo')->getClientOriginalName());
            $extension = $request->file('logo')->extension();
            $new_logo_name = $logo_name.'.'.$extension;
            $pathLogo = $request->file('logo')->storeAs('companies/'.$company->slug, $new_logo_name, 'public');

            $company->logo = $pathLogo;
        }
        $company->website = $request->website;

        $company->save();

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($companyName)
    {
        $company = Company::firstWhere('slug', $companyName);
        
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($companyName)
    {
        $company = Company::firstWhere('slug', $companyName);
        
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyName)
    {
        $company = Company::where('slug', $companyName)->firstOrFail();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('companies')->ignore($company->id)],
            'email' => ['required', 'email', Rule::unique('companies')->ignore($company->id)],
            'logo' => 'image',
            'website' => 'url|max:255'
        ]);

        
        
        $company->name = $request->name;
        $company->email = $request->email;

        if ($request->file('logo')) {

            Storage::delete([$company->logo]);

            $logo_name = Str::slug($request->file('logo')->getClientOriginalName());
            $extension = $request->file('logo')->extension();
            $new_logo_name = $logo_name.'.'.$extension;
            $pathLogo = $request->file('logo')->storeAs('companies/'.$company->slug, $new_logo_name, 'public');

            $company->logo = $pathLogo;
        }

        $company->website = $request->website;

        $company->update();

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($companyName)
    {
        $company = Company::firstWhere('slug', $companyName);


        Storage::delete([$company->logo]);

        $company->delete();

        return redirect()->back();
    }
}

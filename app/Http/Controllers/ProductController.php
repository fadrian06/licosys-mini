<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    return view('products.index', [
      'products' => Product::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('products.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'unit_price' => 'required|numeric|min:0',
      'revenue' => 'required|numeric|min:0',
    ]);

    Product::create($request->only(['name', 'unit_price', 'revenue']));

    return redirect()
      ->route('products.index')
      ->with('success', 'Product created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product): View
  {
    return view('products.show', [
      'product' => $product,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product): View
  {
    return view('products.edit', [
      'product' => $product,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product): RedirectResponse
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'unit_price' => 'required|numeric|min:0',
      'revenue' => 'required|numeric|min:0',
    ]);

    $product->update($request->only(['name', 'unit_price', 'revenue']));

    return redirect()
      ->route('products.index')
      ->with('success', 'Product updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product): RedirectResponse
  {
    $product->delete();

    return redirect()
      ->route('products.index')
      ->with('success', 'Product deleted successfully.');
  }
}

<?php

namespace tests\Feature\Buyer\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsSearchScreenCanBeRendered(): void
    {
        $response = $this->get(Product::buyerIndexRoute(), [
            'search' => 'search',
            'category' => '1',
            'priceFrom' => '10',
            'priceTo' => '10000',
        ]);

        // assertions
        $this->assertGuest();

        $response->assertOk();

        $response->assertViewIs(Product::buyerIndexView());
    }

    /*public function testSearchResultsAreCorrect(callable $data): void
    {
        Category::factory()->Has(Product::factory())
            ->create([
                'name' => trans('categories.cleaning'),
            ]);

        Category::factory()->Has(Product::factory())
            ->create([
                'name' => trans('categories.food'),
            ]);

        //dd($data());

        $info = $data();

        $data = $info['data'];
        $productsQuery = $info['products'];


        $response = $this->get(route('buyer.products.index', ));


        $productsQuery1 = Product::search('quidem')
            ->count();

        $productsQuery2 = Product::search('quidem')
            ->categoryFilter($category->id)
            ->count();
        $productsQuery3 = Product::search('quidem')
            ->categoryFilter($category->id)
            ->priceFilter('10000')
            ->count();

        $productsQuery4 = Product::search('quidem')
            ->categoryFilter($category->id)
            ->priceFilter('10000', '20000')
            ->count();

        $response1 = $this->get(route('buyer.products.index'), [
            'search' => 'quidem',
        ]);

        $response2 = $this->get(route('buyer.products.index'), [
            'search' => 'quidem',
            'category' => '1',
        ]);

        $response3 = $this->get(route('buyer.products.index'), [
            'search' => 'quidem',
            'category' => '1',
            'priceFrom' => '10000',
        ]);

        $response4 = $this->get(route('buyer.products.index', [
            'search' => 'quidem',
            'category' => '1',
            'priceFrom' => '10000',
            'priceTo' => '20000',
        ]));

        //dd($response1->getOriginalContent()->getData()['products']->total(), $productsQuery2,$productsQuery3,$productsQuery4);
        //$this->assertEquals($productsQuery1, $response1->getOriginalContent()->getData()['products']->getCollection()->count());

        $this->assertEquals($productsQuery, $response->getOriginalContent()->getData()['products']->getCollection()->count());
        $this->assertEquals($productsQuery3, $response3->getOriginalContent()->getData()['products']->getCollection()->count());
        $this->assertEquals($productsQuery4, $response4->getOriginalContent()->getData()['products']->getCollection()->count());

        $response1->assertViewIs('buyer.products.index');
        $response2->assertViewIs('buyer.products.index');
        $response3->assertViewIs('buyer.products.index');
        $response4->assertViewIs('buyer.products.index');
    }

    public function searchProductDataProvider(): array
    {
        $category = Category::select('id')->where('name', trans('categories.cleaning'))->first();
        $product = $category->products()->first()->name;
        dd($category, $product);
        return [
            'The category can be filtered' => [
                function () {
                    $category = Category::select('id')->where('name', trans('categories.cleaning'))->first();
                    $product = $category->products()->first()->name;
                    return [
                        'data' => [
                            'search' => $product,
                            'category' => $category->id,
                        ],
                        'products' => Product::search($product)
                            ->categoryFilter($category->id)
                            ->count(),
                    ];
                }

            ],


        ];
    }*/
}

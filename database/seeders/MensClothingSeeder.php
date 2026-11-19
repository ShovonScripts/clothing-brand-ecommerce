<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MensClothingSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        /* ------------------------------------------------------------------
         |  Brand + store information
         * ------------------------------------------------------------------ */
        DB::table('informations')->where('id', 1)->update([
            'site_name' => 'GENTRY',
            'site_logo' => 'gentry-logo.svg',
            'favicon' => 'gentry-favicon.svg',
            'owner_phone' => '+880 1700 000 000',
            'owner_email' => 'care@gentry.com',
            'address' => 'House 12, Road 7, Banani, Dhaka 1213',
            'copyright' => '© '.date('Y').' GENTRY. All rights reserved.',
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.instagram.com/',
            'youtube' => 'https://www.youtube.com/',
            'recommend_num' => 8,
            'discount_num' => 8,
            'newarrival_num' => 8,
            'currency' => 'BDT',
            'og_images' => 'gentry-logo.svg',
        ]);

        DB::table('bangla_text')->where('id', 1)->update([
            'order_text' => 'Add to bag',
            'cart_text' => 'Add to bag',
            'checkout_form_top_text' => 'Enter your details below to complete your order.',
            'name_text' => 'Your name',
            'mobile_text' => 'Your mobile number',
            'address_text' => 'Your full address',
            'order_confirm_text' => 'Place order',
            'delivery_text' => 'Select a delivery area',
            'select_text' => 'Select one',
            'fshipping_text' => 'Free shipping',
        ]);

        /* ------------------------------------------------------------------
         |  Editorial pages
         * ------------------------------------------------------------------ */
        DB::table('pages')->where('page', 'about')->delete();
        DB::table('pages')->insert([
            'page' => 'about',
            'title' => 'Clothes for the life you actually live.',
            'body' => '<h2>Our approach</h2><p>We work with a small number of mills and makers who share our standards. Natural fibres, honest construction and a fit that is tested on real bodies — not just on a mannequin. Every piece is designed to work with the rest of the wardrobe, so getting dressed stays effortless.</p><h2>Considered by design</h2><p>We release fewer, better things. Instead of chasing every trend, we refine the essentials: the oxford shirt that breaks in beautifully, the trouser with the right break, the jacket that earns its place by the door.</p><blockquote>Good clothes should feel like a decision you made once, and then never had to think about again.</blockquote><h2>Made to last</h2><p>We believe in buying less and wearing more. Our garments are built to be repaired, re-worn and passed on. If something isn\'t right, our client services team is here to help — seven days a week.</p>',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('pages')->where('page', 'term')->delete();
        DB::table('pages')->insert([
            'page' => 'term',
            'title' => 'Terms & conditions',
            'body' => '<h2>Orders</h2><p>All orders are subject to acceptance and stock availability. We reserve the right to decline or cancel an order where there is an error in pricing, availability or payment.</p><h2>Pricing</h2><p>Prices are shown in the currency selected at checkout and include applicable taxes where required. Delivery charges are shown before you confirm your order.</p><h2>Delivery</h2><p>We aim to dispatch orders within one business day. Delivery estimates are indicative and not guaranteed. Risk passes to you on delivery.</p><h2>Intellectual property</h2><p>All content on this site — including text, images, logos and designs — is owned by or licensed to GENTRY and may not be reproduced without permission.</p>',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        /* ------------------------------------------------------------------
         |  Categories
         * ------------------------------------------------------------------ */
        DB::table('categories')->delete();
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');

        $categoryDefs = [
            'shirts' => [
                'name' => 'Shirts',
                'image' => 'mens-shirts.jpg',
                'subs' => [
                    'casual-shirts' => 'Casual Shirts',
                    'formal-shirts' => 'Formal Shirts',
                    'linen-shirts' => 'Linen Shirts',
                ],
            ],
            't-shirts' => [
                'name' => 'T-Shirts',
                'image' => 'mens-tshirts.jpg',
                'subs' => [
                    'crew-neck-tees' => 'Crew Neck',
                    'graphic-tees' => 'Graphic Tees',
                ],
            ],
            'polos' => [
                'name' => 'Polos',
                'image' => 'mens-polos.jpg',
                'subs' => [
                    'classic-polos' => 'Classic Polos',
                    'knit-polos' => 'Knit Polos',
                ],
            ],
            'trousers' => [
                'name' => 'Trousers',
                'image' => 'mens-trousers.jpg',
                'subs' => [
                    'chinos' => 'Chinos',
                    'formal-trousers' => 'Formal Trousers',
                ],
            ],
            'denim' => [
                'name' => 'Denim',
                'image' => 'mens-denim.jpg',
                'subs' => [
                    'slim-jeans' => 'Slim Jeans',
                    'straight-jeans' => 'Straight Jeans',
                ],
            ],
            'jackets' => [
                'name' => 'Jackets',
                'image' => 'mens-jackets.jpg',
                'subs' => [
                    'denim-jackets' => 'Denim Jackets',
                    'bomber-jackets' => 'Bomber Jackets',
                    'knitwear' => 'Knitwear',
                ],
            ],
            'tailoring' => [
                'name' => 'Tailoring',
                'image' => 'mens-suits.jpg',
                'subs' => [
                    'blazers' => 'Blazers',
                    'suits' => 'Suits',
                ],
            ],
            'accessories' => [
                'name' => 'Accessories',
                'image' => 'mens-accessories.jpg',
                'subs' => [
                    'watches' => 'Watches',
                    'bags' => 'Bags',
                    'footwear' => 'Footwear',
                    'caps' => 'Caps & Hats',
                ],
            ],
        ];

        $catIds = [];
        $subIds = [];

        foreach ($categoryDefs as $slug => $def) {
            $parentId = DB::table('categories')->insertGetId([
                'name' => $def['name'],
                'url' => $slug,
                'parent_id' => null,
                'image' => $def['image'],
                'is_popular' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $catIds[$slug] = $parentId;

            foreach ($def['subs'] as $subSlug => $subName) {
                $subIds[$subSlug] = DB::table('categories')->insertGetId([
                    'name' => $subName,
                    'url' => $subSlug,
                    'parent_id' => $parentId,
                    'image' => $def['image'],
                    'is_popular' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        /* ------------------------------------------------------------------
         |  Brands
         * ------------------------------------------------------------------ */
        DB::table('types')->delete();
        DB::statement('ALTER TABLE types AUTO_INCREMENT = 1');

        $brandIds = [];
        foreach (['Gentry', 'Northline', 'Atelier No. 8', 'Riviera', 'Heritage', 'Sunday Standard'] as $index => $brand) {
            $brandIds[$brand] = DB::table('types')->insertGetId([
                'name' => $brand,
                'image' => null,
                'is_top' => $index < 4 ? 1 : null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        /* ------------------------------------------------------------------
         |  Sizes
         * ------------------------------------------------------------------ */
        $sizeTitles = ['S', 'M', 'L', 'XL', 'XXL', '40', '41', '42', '43'];
        $sizeIds = [];
        foreach ($sizeTitles as $title) {
            $id = DB::table('sizes')->where('title', $title)->value('id');
            if (!$id) {
                $id = DB::table('sizes')->insertGetId([
                    'title' => $title,
                    'is_default' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
            $sizeIds[$title] = $id;
        }

        /* ------------------------------------------------------------------
         |  Products
         * ------------------------------------------------------------------ */
        $products = [
            ['The Oxford Shirt', 'shirts', 'formal-shirts', 'Gentry', 2490, 3200, 'mens-oxford-shirt.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Sky', 'A clean, versatile oxford cut from breathable cotton with a soft roll collar.'],
            ['The Linen Shirt', 'shirts', 'linen-shirts', 'Riviera', 2790, 3490, 'mens-linen-shirt.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Sand', 'Relaxed linen shirting with a natural texture that only gets better with wear.'],
            ['Check Overshirt', 'shirts', 'casual-shirts', 'Northline', 2990, 3990, 'mens-check-shirt.jpg', 0, 'variable', ['M', 'L', 'XL', 'XXL'], 'Blue', 'A lightweight overshirt in brushed cotton check, made for layering.'],
            ['The Essential Tee', 't-shirts', 'crew-neck-tees', 'Gentry', 990, 1290, 'mens-white-tee.jpg', 1, 'variable', ['S', 'M', 'L', 'XL', 'XXL'], 'White', 'Our everyday crew neck in heavyweight cotton with a clean, structured drape.'],
            ['The Black Tee', 't-shirts', 'crew-neck-tees', 'Gentry', 990, 1290, 'mens-black-tee.jpg', 0, 'variable', ['S', 'M', 'L', 'XL', 'XXL'], 'Black', 'A deep black crew neck with a slightly boxy fit and a soft hand feel.'],
            ['Graphic Tee', 't-shirts', 'graphic-tees', 'Sunday Standard', 1290, 1690, 'mens-graphic-tee.jpg', 0, 'variable', ['S', 'M', 'L', 'XL'], 'Black', 'A relaxed graphic tee with a subtle print and a lived-in finish.'],
            ['Striped Tee', 't-shirts', 'graphic-tees', 'Sunday Standard', 1190, 1490, 'mens-striped-tee.jpg', 0, 'variable', ['S', 'M', 'L', 'XL'], 'Navy', 'Breton-inspired stripes on a soft cotton jersey base.'],
            ['Navy Polo', 'polos', 'classic-polos', 'Heritage', 1890, 2390, 'mens-navy-polo.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Navy', 'A refined piqué polo with a neat collar and a tailored fit.'],
            ['White Polo', 'polos', 'classic-polos', 'Heritage', 1890, 2390, 'mens-white-polo.jpg', 0, 'variable', ['M', 'L', 'XL', 'XXL'], 'White', 'Clean, crisp and endlessly wearable — our take on the classic polo.'],
            ['Slim Jeans', 'denim', 'slim-jeans', 'Northline', 3290, 4190, 'mens-slim-jeans.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Indigo', 'Slim through the leg with a touch of stretch for all-day comfort.'],
            ['The Chino', 'trousers', 'chinos', 'Gentry', 2690, 3290, 'mens-chinos.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Stone', 'A modern chino with a clean front and a versatile, tapered leg.'],
            ['Formal Trouser', 'trousers', 'formal-trousers', 'Atelier No. 8', 2990, 3790, 'mens-formal-trousers.jpg', 0, 'variable', ['M', 'L', 'XL', 'XXL'], 'Charcoal', 'A sharp formal trouser with a pressed crease and a comfortable waistband.'],
            ['Denim Jacket', 'jackets', 'denim-jackets', 'Northline', 4490, 5490, 'mens-denim-jacket.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Indigo', 'A timeless denim jacket in a mid-weight wash, built to layer.'],
            ['Bomber Jacket', 'jackets', 'bomber-jackets', 'Riviera', 4990, 6290, 'mens-bomber-jacket.jpg', 0, 'variable', ['M', 'L', 'XL', 'XXL'], 'Rust', 'A clean bomber in a matte technical fabric with a ribbed finish.'],
            ['The Hoodie', 'jackets', 'knitwear', 'Sunday Standard', 2790, 3490, 'mens-hoodie.jpg', 0, 'variable', ['M', 'L', 'XL', 'XXL'], 'Grey', 'A heavyweight hoodie with a relaxed fit and a brushed interior.'],
            ['The Sweatshirt', 'jackets', 'knitwear', 'Sunday Standard', 2390, 2990, 'mens-sweatshirt.jpg', 0, 'variable', ['M', 'L', 'XL', 'XXL'], 'Oat', 'A classic crew sweatshirt in loopback cotton, made to be lived in.'],
            ['The Blazer', 'tailoring', 'blazers', 'Atelier No. 8', 6990, 8990, 'mens-blazer.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Navy', 'An unlined blazer with a soft shoulder and a clean, modern lapel.'],
            ['The Suit', 'tailoring', 'suits', 'Atelier No. 8', 12990, 16990, 'mens-suit.jpg', 1, 'variable', ['M', 'L', 'XL', 'XXL'], 'Blue', 'A two-piece suit in a refined wool blend, cut for a confident silhouette.'],
            ['Court Sneaker', 'accessories', 'footwear', 'Riviera', 3990, 4990, 'mens-sneakers.jpg', 1, 'single', ['40', '41', '42', '43'], 'Tan', 'A minimal leather sneaker with a cupsole and a clean, tonal finish.'],
            ['Leather Derby', 'accessories', 'footwear', 'Heritage', 5490, 6990, 'mens-leather-shoes.jpg', 0, 'single', ['40', '41', '42', '43'], 'Tan', 'A classic derby in full-grain leather, Goodyear-welted for longevity.'],
            ['The Watch', 'accessories', 'watches', 'Gentry', 6990, 8990, 'mens-watch.jpg', 1, 'single', [], 'Steel', 'A slim, understated watch with a brushed steel case and a leather strap.'],
            ['The Backpack', 'accessories', 'bags', 'Northline', 3490, 4290, 'mens-backpack.jpg', 0, 'single', [], 'Navy', 'A clean everyday backpack in water-resistant canvas with a padded laptop sleeve.'],
            ['Leather Belt', 'accessories', 'bags', 'Heritage', 1890, 2390, 'mens-leather-belt.jpg', 0, 'single', [], 'Brown', 'A full-grain leather belt with a brushed metal buckle, made to last.'],
            ['The Cap', 'accessories', 'caps', 'Sunday Standard', 1290, 1590, 'mens-cap.jpg', 0, 'single', [], 'White', 'A six-panel cap in washed cotton twill with a low-profile fit.'],
        ];

        $existingIds = DB::table('products')->orderBy('id')->pluck('id')->all();

        DB::table('variations')->delete();
        DB::table('product_stocks')->delete();
        DB::table('product_images')->delete();
        DB::table('product_sizes')->delete();

        foreach ($products as $index => $p) {
            [$name, $cat, $sub, $brand, $price, $original, $image, $recommended, $type, $sizes, $color, $description] = $p;

            $hasDiscount = $original > $price;
            $discountPercent = $hasDiscount ? (int) round((($original - $price) / $original) * 100) : 0;

            $data = [
                'name' => $name,
                'sku' => 'GTY-'.str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                'type' => $type,
                'category_id' => $catIds[$cat],
                'sub_category_id' => $subIds[$sub] ?? null,
                'type_id' => $brandIds[$brand] ?? null,
                'purchase_price' => round($price * 0.55, 2),
                'sell_price' => $original,
                'regular_price' => $original,
                'image' => $image,
                'description' => $description,
                'body' => '<p>'.$description.'</p><ul><li>Considered fit and finish</li><li>Responsibly sourced materials</li><li>Designed in our studio, made by specialist makers</li></ul>',
                'feature' => '<li>Premium materials</li><li>Modern, wearable fit</li><li>Easy 14-day returns</li>',
                'color' => $color,
                'discount_type' => $hasDiscount ? 'percentage' : null,
                'after_discount' => $hasDiscount ? $price : 0,
                'dicount_amount' => $hasDiscount ? ($original - $price) : 0,
                'discount' => $discountPercent,
                'is_recommended' => $recommended,
                'is_free_shipping' => $price >= 2490 ? 1 : 0,
                'is_stock' => 1,
                'user_id' => 1,
                'updated_at' => $now,
            ];

            if (isset($existingIds[$index])) {
                $productId = $existingIds[$index];
                DB::table('products')->where('id', $productId)->update($data);
            } else {
                $data['created_at'] = $now;
                $productId = DB::table('products')->insertGetId($data);
            }

            if ($type === 'single' && empty($sizes)) {
                $variationId = DB::table('variations')->insertGetId([
                    'product_id' => $productId,
                    'size_id' => null,
                    'color_id' => null,
                    'weight_id' => null,
                    'price' => $price,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                DB::table('product_stocks')->insert([
                    'product_id' => $productId,
                    'variation_id' => $variationId,
                    'quantity' => 40,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                foreach ($sizes as $sizeTitle) {
                    $variationId = DB::table('variations')->insertGetId([
                        'product_id' => $productId,
                        'size_id' => $sizeIds[$sizeTitle] ?? null,
                        'color_id' => null,
                        'weight_id' => null,
                        'price' => $price,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                    DB::table('product_stocks')->insert([
                        'product_id' => $productId,
                        'variation_id' => $variationId,
                        'quantity' => 40,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        /* ------------------------------------------------------------------
         |  Sliders + homepage banners
         * ------------------------------------------------------------------ */
        DB::table('sliders')->delete();
        DB::table('sliders')->insert([
            [
                'image' => 'mens-hero-1.jpg',
                'mobile_image' => 'mens-hero-1.jpg',
                'title' => 'The New Tailoring',
                'description' => 'Considered layers, refined textures and a sharper silhouette — built for the everyday.',
                'link' => '/products-list',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'mens-hero-2.jpg',
                'mobile_image' => 'mens-hero-2.jpg',
                'title' => 'Quiet Confidence',
                'description' => 'A study in modern menswear. Understated pieces with an unmistakable point of view.',
                'link' => '/products-list?shorting=desc',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'mens-hero-3.jpg',
                'mobile_image' => 'mens-hero-3.jpg',
                'title' => 'Season Sale',
                'description' => 'Up to 40% off selected knitwear, outerwear and everyday essentials.',
                'link' => '/discount-products',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('home_section_images')->delete();
        DB::table('home_section_images')->insert([
            [
                'title' => 'The tailoring edit',
                'text' => 'Sharp lines, soft structure.',
                'image' => 'mens-banner-2.jpg',
                'mobile_image' => 'mens-banner-2.jpg',
                'section' => 1,
                'link' => '/products-list?category_id='.$catIds['tailoring'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Season sale',
                'text' => 'Limited time offers.',
                'image' => 'mens-banner-1.jpg',
                'mobile_image' => 'mens-banner-1.jpg',
                'section' => 2,
                'link' => '/discount-products',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Lookbook — Volume 04',
                'text' => 'Dress with intention.',
                'image' => 'mens-banner-3.jpg',
                'mobile_image' => 'mens-banner-3.jpg',
                'section' => 3,
                'link' => '/products-list',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->command->info('GENTRY menswear catalog seeded successfully.');
    }
}

# GENTRY UI Fix — অবস্থা ও পরের কাজের নির্দেশনা

**তারিখ:** 2026-11-20
**Branch:** `fix/ui-rebuild-crashes` (local, push হয়নি)
**ভিত্তি:** `a2301fb` = rebuild শুরুর আগের শেষ ভালো commit · `e0c8050` = "Option C" rebuild-এর শেষ commit (ভাঙা)
**সম্পর্কিত:** [ui-ux-rebuild-plan.md](ui-ux-rebuild-plan.md)

---

## এক নজরে

আগের একটা AI সেশনের "Option C" rebuild-কে "Ready for Production" বলা হয়েছিল, কিন্তু আসলে **আগে কাজ করত এমন ২৩টা পেজ crash করছিল**, আর আরও কিছু পেজ নিঃশব্দে ভুল দেখাচ্ছিল। এই branch-এ সেগুলো ঠিক করা হয়েছে।

এখনকার অবস্থা: **লিস্টিং → কার্ট → checkout → অর্ডার → অর্ডার পেজ, পুরো কেনাকাটার প্রবাহ কাজ করে।** End-to-end টেস্টের ৩৭/৩৭ চেক পাস করেছে, আর ডাটাবেসে সংরক্ষিত `final_amount` checkout-এ দেখানো মোটের সাথে হুবহু মেলে।

**বাকি একমাত্র জরুরি কাজ: প্রোডাক্ট ডিটেইল পেজ** (৬টা বাগ, নিচে ধাপে ধাপে লেখা)। ততক্ষণ কাস্টমার লিস্টিং পেজের "Add to bag" দিয়ে কিনতে পারে, প্রোডাক্ট পেজ থেকে পারে না।

**এই branch `main`-এ merge বা লাইভ করবেন না** যতক্ষণ না নিচের "পরের কাজ ১" আর "২" শেষ হয়।

---

## Git অবস্থা

| কী | অবস্থা |
|---|---|
| `de03431` | এই branch-এ commit হয়েছে (আমি করিনি, editor বা হাতে হয়েছে)। Message "Refactor user management views…" **ভুল**। আসলে এতে আছে: ১৫টা admin view `a2301fb`-এ ফেরানো, ২টা ভাঙা admin view মোছা, আর মুছে ফেলা পুরনো CSS ফাইল ফেরানো। |
| বাকি সব পরিবর্তন | **uncommitted**: ৫৩টা modified ফাইল, আর নতুন `resources/js/ui.js`, `resources/scss/pages/_account.scss`, `components/ui/accordion-item.blade.php`, `frontend/dashboard/partials/`, `frontend/products/partials/card.blade.php`, `tools/qa/`, এই doc। |
| `storage/framework/views/*` | compile করা view git-এ track করা আছে (আগের সমস্যা)। এগুলোর পরিবর্তন commit করবেন না। |

---

## যা ঠিক করা হয়েছে

### Admin panel: rebuild-এর আগের অবস্থায় ফেরানো
- নতুন admin layout পুরনো theme-এর CSS (`app-creative.min.css`, `icons.min.css`) লোড করত না, ফলে ছোঁয়া হয়নি এমন ৮৫+ screen স্টাইল ছাড়া দেখাত। এছাড়া ১১টা নতুন লেখা screen crash করত, কারণ সেগুলো এমন variable ব্যবহার করত যেটা controller পাঠায় না।
- তাই `resources/views/backend/*`-এর সব ফাইল `a2301fb`-এর সাথে হুবহু এক করা হয়েছে (একমাত্র ব্যতিক্রম `landing_pages/land_page.blade.php`-এর footer credit, নিচে দেখুন)।
- `components/admin/*` আর `resources/scss/admin.scss` রয়ে গেছে, কিন্তু অব্যবহৃত।

### Header, footer, cart sidebar: পুরনো CSS ফেরানো
- rebuild `style.min.css`, `header.css`, `update.css`, `newstyle.css`, `mens.css` আর `vendor/font-awesome.css` মুছে দিয়েছিল। কিন্তু layout, header, footer আর cart sidebar partial **কখনো migrate হয়নি**, আর এগুলো ওই CSS-এর উপর নির্ভর করে (footer মাত্র ১৯% styled ছিল)।
- ফাইলগুলো ফেরানো হয়েছে আর `frontend/partials/head.blade.php`-এ আগের ক্রমেই লোড হয়, নতুন `app.css`-এর আগে।
- `mens.css` আর `legacy.css` থেকে শুধু `.gm-btn`, `.gm-btn--ghost`, `.gm-faq` সরানো হয়েছে, কারণ এগুলো নতুন design system-এর মালিকানাধীন আর `!important` দিয়ে সংঘর্ষ করছিল।
- `app.scss` থেকে `components/header`, `footer`, `mobile-nav`, `drawer` বাদ দেওয়া হয়েছে। এদের component কোথাও ব্যবহার হয় না, অথচ এদের selector (`.gm-header`, `.gm-footer`, `.gm-nav`, `.gm-drawer`…) লাইভ header/footer-কে আংশিক নতুন করে স্টাইল করছিল।

### সাধারণ (সব পেজে ছড়ানো) ভুল
| ভুল | কতগুলো | সমাধান |
|---|---|---|
| Blade-এ `\$variable` (shell heredoc থেকে আসা escape) | ১০টা ফাইলে ১৫২টা | `$` দিয়ে বদলানো |
| Livewire-এর `wire:*` attribute (Livewire ইনস্টলই নেই) | ১২৪টা | মুছে ফেলা |
| `$wire.xxx`, `@this` | ৮টা | মুছে ফেলা (`quick-view`-এ একটা `@this` রয়ে গেছে, সেটা অব্যবহৃত) |
| `wire:` সরানোর পর component tag-এর ভেতরে খালি `@if(...) @endif` | ২৯টা | মুছে ফেলা (compile error হচ্ছিল) |
| Script push করা হতো `scripts` / `scripts-bottom` stack-এ, যেটা layout-এ ছিল না | ৩৫টা push | `frontend/partials/js.blade.php`-এ দুটো `@stack` যোগ |
| Bootstrap JS দুবার লোড (vendor v5.1.3 + Vite bundle v5.3.9), ফলে toggle দুবার চলত | — | `resources/js/app.js` এখন শুধু `ui.js` import করে; bundle ১৭১KB থেকে ~৪KB |

### নতুন / নতুন করে লেখা component
- `button`: array-তে `->merge()` ডাকা আর `<@php($tag)>` বাগ ঠিক।
- `tabs` + নতুন API `:labels`: আগের `DOMDocument` parsing বাংলা লেখা ভাঙত, আর script-ও কখনো চলত না।
- `accordion` + নতুন `accordion-item`: নেটিভ `<details>`।
- `quantity-stepper`: +/- এখন কাজ করে, আর "Only 99 left" ভুল বার্তা আর দেখায় না।
- `cart-line`: `data-gm-cart-qty` / `data-gm-cart-remove`, আর checkout-এর জন্য `editable` অপশন।
- `order-summary`: `priceFormate()` দিয়ে মুদ্রা, আর বানানো "৳৫০০০-এর উপরে ফ্রি ডেলিভারি" সরানো।
- `filter-sidebar`: সাধারণ form field; input-এর নাম controller-এর parameter অনুযায়ী।
- `drawer`, `modal`: শুধু markup আর `data-` attribute। দুটোই এখন অব্যবহৃত।
- `product-card`: `actions` এখন একটা named slot।
- `gallery`: thumbnail-এ ক্লিক করলে ছবির নাম `800x800.jpg` দিয়ে বদলে যেত, সেটা ঠিক।
- নতুন `resources/js/ui.js`: event delegation দিয়ে tabs, accordion, quantity stepper, drawer/modal সামলায়।

### পেজ
| পেজ | কী ভুল ছিল | এখন |
|---|---|---|
| `/products-list` | `$products ?? empty`, তাই **সবসময় "No products"** দেখাত | Controller-এর AJAX (`index_data`) দিয়ে লোড; ফিল্টার `cat_id[]`, `size_id[]`, `brand_id`, `shorting`; মোবাইলে ফিল্টার drawer |
| discount / combo / free-shipping | `$cats` undefined, আর সবসময় খালি | প্রতিটা নিজ controller-এর ডেটায়; ভুয়া ফিল্টার সরানো |
| `/carts` | crash; **ডাবল ডিসকাউন্ট**; ভুয়া ১০০ টাকা ডেলিভারি; পরিমাণ বদলে POST→405 | মোট = Σ(দাম×পরিমাণ); ডেলিভারি "Calculated at checkout"; edit = GET, destroy = DELETE |
| `/checkouts` | `$wire` crash; ডাবল ডিসকাউন্ট; **AJAX submit ছিল না, কাস্টমার কাঁচা JSON দেখত**; `ip_address` (required) কখনো ভরত না, ফলে প্রতিটা অর্ডার বাতিল হতো | মোট = subtotal + delivery − coupon (controller-এর সূত্র); `checkout.js` ফেরানো; `ip_address` server-side থেকে ভরা; ভাঙা Stripe/PayPal লুকানো |
| `/orders`, `/orders/{id}` | `$orders`/`$order` undefined; `date->format()` string-এ; ভুল status নাম; লগআউট কাজ করত না; অস্তিত্বহীন invoice route | সব ঠিক; sidebar এখন `frontend/dashboard/partials/sidebar.blade.php` |
| `/login` | `$wire` crash; অস্তিত্বহীন `route('register')` | ঠিক |

### আগের ডেভেলপারের অবশেষ
- OTP SMS-এ "Visit softitsecurity.com" (`AuthController`, ২ জায়গায়) আর "Visit excellentfood.com.bd" (`PasswordResetController`, ৩ জায়গায়) সরানো। শুধু লেখা বদলেছে, লজিক না।
- Landing page footer-এর "2023 VesojCity.com | Developed By Vesojcity" সরিয়ে আপনার স্টোরের নাম বসানো।
- **সংশোধন:** আগে বলা হয়েছিল SMS-এর সব কল comment করা। সেটা ভুল ছিল। `sendSMS()` সক্রিয়ভাবে ৫ জায়গা থেকে ডাকা হয় (লগইন OTP ×২, পাসওয়ার্ড রিসেট ×৩)। আগের ডেভেলপারের credential সরানোর আগে কাস্টমারের নম্বর আর OTP তাদের গেটওয়েতে যেত।

---

## যাচাই করার নিয়ম

Script-গুলো আছে [tools/qa/](../tools/qa/)-এ। প্রজেক্ট রুট থেকে চালান:

```bash
php artisan view:clear && php artisan view:cache      # সব Blade compile হতে হবে
npm run build
php tools/qa/crawl.php "$(pwd)" 157 1257               # সব GET route চালায়
php tools/qa/flow-test.php "$(pwd)" 157 246 1          # কেনাকাটার পুরো প্রবাহ, DB rollback হয়
php tools/qa/js-check.php "$(pwd)" 157 246 1 storage/app/jscheck   # inline JS syntax (Node লাগবে)
php tools/qa/lint-blade.php "$(pwd)" $(find resources/views -name '*.blade.php' -size +0c)
```

ID-গুলো local DB-র জন্য: `157` = Demo Product, `246` = তার variation, `1257` = একটা অর্ডার, ইউজার `1` = অর্ডারের মালিক। অন্য DB-তে এগুলো বদলাতে হবে।

**বর্তমান baseline:**
- `view:cache` সফল
- flow-test **37/37 PASS**
- js-check: ৫০টা script, **০টা error**
- crawl: **98 × 200, 31 × 500**। বাকি ৩১টা সবই rebuild-এর আগে থেকে ছিল (নিচে "আগের বাগ" দেখুন)। নতুন কোনো 500 এলেই সেটা রিগ্রেশন।

---

## পরের কাজ (অগ্রাধিকার অনুযায়ী)

### ১. প্রোডাক্ট ডিটেইল পেজ (জরুরি)

ফাইল: `resources/views/frontend/products/show.blade.php` (controller: `Frontend\ProductController@show`, দেয় `$product`, `$products`)।

- [ ] **মূল ছবি ভাঙা।** লাইন ~16-এ `$images`-এ শুধু ফাইলের নাম থাকে (`mens-black-tee.jpg`)। প্রতিটা নাম `getImage('products', $file)` দিয়ে map করুন। মূল আর অতিরিক্ত দুই ধরনের ছবিই `public/products/`-এ থাকে।
- [ ] **স্টক লজিক ভুল।** `is_stock` একটা **flag** (০ = স্টক গোনা হয় না, ≠০ = গোনা হয়), পরিমাণ না। সঠিক নিয়ম:
  - `$tracked = (int) $product->is_stock !== 0`
  - গোনা হলে আসল stock = `app(\App\Utils\Util::class)->checkProductStock($product->id, $variationId)` (`CartController` এটাই ব্যবহার করে)
  - "Out of stock" দেখাবেন শুধু যখন `$tracked && $stock <= 0`
  - Stepper-এর `max` = গোনা হলে `$stock`, না হলে ৯৯
  - hidden `is_stock` = `$product->is_stock` (flag)
- [ ] **সাইজ বাছাই কাজ করে না।** `components/ui/variant-swatch.blade.php`-এ `uniqid()` দুবার ডাকা হয়, তাই radio-র `id` ≠ label-এর `for`। id একবার গণনা করুন। প্রোডাক্ট পেজে আলাদা লুকানো radio-গুলো মুছে swatch-কেই `name="variation_id"` দিন। একই ফাইলে `{{ $style }}` escape হয়ে attribute ভাঙে, ঠিক করুন।
- [ ] **Add to bag কাঁচা JSON দেখায়।** Form-কে `class="gm-quick-add"` দিন। `frontend/partials/js.blade.php`-এর global handler AJAX-এ `storeCart`-এ পাঠাবে আর toast দেখাবে। দ্বিগুণ hidden `quantity` আর `<input name="price" :value=...>` (অকেজো) মুছুন।
- [ ] **বানানো প্রতিশ্রুতি মুছুন** (লাইন ~165–179): "Free delivery over ৳5,000" আর "14-day easy returns"। এর বদলে লিখুন "Delivery charge is calculated at checkout" আর `route('front.returnPolicy')`-এ লিংক দিন।
- [ ] **"Save for later" অকেজো।** মুছুন, অথবা আগে `UserWishlistController@store` দেখে আসলভাবে বানান।
- [ ] অব্যবহৃত `$currencySymbol` মুছুন। Inline `grid-template-columns: 1fr 480px` আর sticky gallery-কে `resources/scss/pages/_pdp.scss`-এ সরান (mobile-first, ১০২৪px থেকে দুই কলাম)।
- [ ] `tools/qa/flow-test.php`-এ চেক যোগ করুন: প্রোডাক্ট পেজের gallery `src` `http` দিয়ে শুরু হয়, form-এ `gm-quick-add` আছে, আর বাছাই করা variation কার্টে যায়।

### ২. শেষ যাচাই আর merge
- [ ] উপরের সব যাচাই command চালান; baseline-এর চেয়ে খারাপ হলে চলবে না।
- [ ] **মালিক ব্রাউজারে দেখবেন** ৩৬০ / ৭৬৮ / ১০২৪ / ১৪৪০px-এ: হোম, শপ (মোবাইল ফিল্টার সহ), প্রোডাক্ট, কার্ট, checkout, অর্ডার, অর্ডার ডিটেইল, header/footer, admin dashboard আর অর্ডার তালিকা।
- [ ] Local DB-তে অন্তত একটা আসল ক্যাশ অর্ডার আর একটা বিকাশ অর্ডার দিয়ে admin-এ দেখুন।
- [ ] Commit করুন (`storage/framework/views` বাদে), তারপর `main`-এ merge।

### ৩. মালিকের করণীয়
- [ ] **SMS গেটওয়ে:** এটা ছাড়া **কাস্টমার OTP লগইন আর পাসওয়ার্ড রিসেট কাজ করবে না।**
  - `.env`-এ `SMS_URL`, `SMS_API_KEY`, `SMS_SECRET_KEY`, `SMS_SENDER_ID` বসান
  - `app/helpers.php` → `SendSms()`-এর query parameter-এর নাম নতুন প্রোভাইডার অনুযায়ী বদলান
  - `Frontend\AuthController@login` (আর `PasswordResetController`) সফলতা যাচাই করে `$res->Status == '0'` দিয়ে, যেটা পুরনো গেটওয়ের format; নতুন প্রোভাইডারের response অনুযায়ী মানিয়ে নিন
- [ ] Admin → Settings-এ `site_name` এখনো "Pallibazarbd"; এটা বদলান। Landing page footer এই নামটাই দেখায়।

### ৪. Backlog (rebuild-এর অসম্পূর্ণ কাজ)
| বিষয় | বিস্তারিত |
|---|---|
| Card-এর wishlist বোতাম | কিছু করে না, আর `<a>`-এর ভেতরে থাকায় ক্লিক করলে প্রোডাক্ট পেজে যায় |
| Stripe / PayPal | লুকানো। Client পাঠায় `stripe_payment_method_id`, কিন্তু controller পড়ে `stripeToken` (Charges API); PayPal-এর জন্য server-এ কোনো শাখাই নেই। Key দিয়ে end-to-end টেস্ট করে তবেই চালু করুন। |
| অব্যবহৃত নতুন view | `frontend/dashboard/index`, `dashboard/account`, `wishlist/index`। Controller রেন্ডার করে `dashboard.dashboard`, `account_details`, `wishlists`। `account` আর `wishlist` অস্তিত্বহীন route ডাকে। Controller মিলিয়ে নতুন করে লিখুন, নয়তো মুছে ফেলুন। |
| অব্যবহৃত component (১৪টা) | header, footer, mobile-nav, drawer, modal, quick-view, alert, checkbox, radio, skeleton, stock-badge, textarea, toast, variant-swatch-group |
| নতুন header/footer চালু করা | `app.scss`-এ এদের SCSS আবার চালু করুন **একই পরিবর্তনে**, যেখানে `frontend/app.blade.php` নতুন component-এ যায়, আর তখনই পুরনো header/footer CSS সরান |
| Admin redesign | পুরোটা ফেরানো হয়েছে। নতুন করে করুন, প্রতিটা screen নিজের controller-এর `compact()` পড়ে |
| ছোটখাটো | `quick-view`-এ `@this` রয়ে গেছে; `rating` `document.currentScript` ব্যবহার করে (push হলে চলে না); `input` component `$attributes` wrapper আর input দুই জায়গায় বসায়; frontend-এ Bootstrap এখনো লোড হয় (plan বলেছিল বাদ দিতে) |
| পুরনো CSS-এর global rule | `header.css`: `iframe { height:150px !important }` (media query-তে, মোবাইলে ভিডিও ছোট); `update.css`: `h2 { margin-bottom:0 !important }` |
| কপি করা কনটেন্ট | `frontend/protecting_our_brands/*` আর `auth/signin.blade.php`-এ Ralph Lauren-এর লেখা (দুটোই route-বিহীন, কিন্তু মুছে ফেলা উচিত) |

### ৫. আগের বাগ (rebuild-এর আগে থেকেই ছিল)
- Admin-এ হাতে অর্ডার তৈরি: `get-order-product`-এ SQL error `Unknown column 'variations.weight_id'`।
- `admin/products/{id}` show: "title on null"; `admin/orders/{id}` (`show_prnt`): `$product` undefined।
- Admin create view নেই: sliders, sizes, weight, colors, delivery_charge, coupon_codes, types। `create()` method নেই: categories, about_us, home-section-images, settings। এই resource route-গুলো UI থেকে লিংক করা নেই, তাই কাস্টমারের সমস্যা না।
- ৩টা খালি Blade ফাইল: `backend/career/create`, `backend/product_discounts/show`, `backend/social_icons/create`।
- `storage/framework/views/*` git-এ track করা: `.gitignore`-এ যোগ করে `git rm --cached` করুন।
- Coupon endpoint-এ লগইন লাগে, তাই গেস্ট coupon দিতে পারে না।
- `CheckoutController` ব্যর্থ হলে কাস্টমারকে `$e->getMessage()` দেখায় (ভেতরের তথ্য ফাঁস হয়)।
- আগের নিরাপত্তা তালিকা থেকে: `APP_DEBUG=true`, রুটের `.htaccess` প্রজেক্ট-রুট থেকে সার্ভ করে।

---

## নিয়ম (এই গোলমাল যেভাবে তৈরি হয়েছিল, সেটা আর না হোক)

1. **View লেখার আগে controller পড়ুন।** `compact()` বা JSON-এ যা আছে শুধু সেটাই ব্যবহার করুন। `$x = $x ?? collect()` দিয়ে অনুপস্থিত ডেটা চাপা দেবেন না; ঠিক এভাবেই শপ পেজ নিঃশব্দে খালি দেখাচ্ছিল।
2. **Livewire বা Alpine syntax না** (`wire:`, `$wire`, `@this`, `$dispatch`, `x-data`)। আচরণ আসবে `data-` attribute আর `resources/js/ui.js` থেকে, অথবা পেজের `@push('scripts')` থেকে।
3. `:attr="..."`-এর ভেতরে `{{ }}` না; `<x-…>` tag-এর ভেতরে `@if` না; **shell heredoc দিয়ে Blade লিখবেন না** (`\$` escape ফাইলে থেকে যায়)।
4. **ব্যবসায়িক নিয়ম বানাবেন না:** ফ্রি-ডেলিভারির সীমা, রিটার্নের দিন, মোটের সূত্র কিছুই না। কার্টের `price` ইতিমধ্যে discount-এর পরের দাম। মোট = Σ(price×qty) + delivery − coupon (`CheckoutController@store`)।
5. মুদ্রা সবসময় `priceFormate()` দিয়ে।
6. `is_stock` একটা flag, পরিমাণ না।
7. পুরনো CSS ফাইল মুছবেন **শুধু তখন**, যখন রেন্ডার হওয়া কোনো template তার class ব্যবহার করে না (মেপে দেখুন)। নতুন class-এর নাম `mens.css`-এর নামের সাথে মিলতে দেবেন না (`gm-header`, `gm-footer`, `gm-nav`, `gm-drawer`, `gm-btn`, `gm-section`, `gm-grid`, `gm-prose`…)।
8. **"শেষ" বলার শর্ত:** `view:cache` সফল + crawl-এ নতুন কোনো 500 নেই + flow-test সব PASS + js-check ০ + একজন মানুষ ব্রাউজারে দেখেছে। `npm run build` সফল হওয়া মানে Blade ঠিক আছে, এমন না।

---

## রেফারেন্স: আসল ডেটা চুক্তি

| কী | মান |
|---|---|
| কার্ট session | `cart[variation_id] = {name, size, color, quantity, price, discount, variation_id, product_id, image, is_stock, is_free_shipping}` |
| কার্টে যোগ | `POST /cart/store` (`front.carts.storeCart`): `product_id, variation_id, quantity, is_stock` → JSON `{success, msg, html, item}` |
| পরিমাণ বদল | `GET /carts/{variation}/edit?quantity=N` (০ দিলে মুছে যায়) → JSON |
| মুছে ফেলা | `DELETE /carts/{variation}` → JSON |
| Checkout POST | `first_name, mobile (১১ ডিজিট), shipping_address, ip_address (required), delivery_charge_id, payment_method (cash/bkash/rocket/nogod), pay_num, tnx_id, note` → AJAX হলে JSON `{success, msg, url}` |
| শপ AJAX | `GET /products-list` + `X-Requested-With`: `cat_id[], size_id[], brand_id (একটা মান), q, shorting (desc/asc/name/price_low/price_high), page` → HTML partial |
| Sale AJAX | `GET /discount-products` + `X-Requested-With` → JSON `{html}` |
| অর্ডারের status | `pending, processing, on_the_way, on_hold, complete, cancell` (লেবেল: `getOrderStatus()`) |
| অর্ডারের মোট (সংরক্ষিত) | `amount − discount + shipping_charge = final_amount`; payment method আর tnx আছে `order_payments`-এ |

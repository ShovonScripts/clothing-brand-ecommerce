# GENTRY — সম্পূর্ণ অ্যাপ বিশ্লেষণ ও কাজের তালিকা

**তারিখ:** 2026-11-20 · **বিশ্লেষণ করা commit:** `c65bcf0` (`main`)
**আগের doc:** [ui-fix-handoff.md](ui-fix-handoff.md) (UI-র অবস্থা ও নিয়ম) · [ui-ux-rebuild-plan.md](ui-ux-rebuild-plan.md)
**পদ্ধতি:** পুরো কোড পড়া + চালিয়ে মাপা — সব GET route crawl, কেনাকাটার end-to-end টেস্ট, inline JS syntax চেক, প্রতি পেজে DB query গণনা, `composer audit` / `npm audit`, DB schema/index/permission পরীক্ষা, আর localhost Apache দিয়ে সংবেদনশীল ফাইলের HTTP পরীক্ষা। প্রতিটা দাবি যাচাই করা; অনুমান হলে সেটা লেখা আছে।

---

## মালিকের জন্য এক নজরে

**দোকান চলে, কিন্তু লাইভ করার মতো নিরাপদ না।**

- ✅ কেনাকাটার প্রবাহ কাজ করে: frontend-এ ০টা crash, end-to-end টেস্ট ৩৭/৩৭ পাস, পেজে দেখানো মোট = DB-তে সংরক্ষিত মোট।
- 🔴 **তিনটা আক্রমণের পথ খোলা, যেগুলো দিয়ে বাইরের যে কেউ আপনার সার্ভার, admin বা সাইট দখল করতে পারে** (SEC-01 … SEC-06)। সবচেয়ে খারাপটা: পাবলিক seller রেজিস্ট্রেশন → admin panel → PHP ফাইল আপলোড → সার্ভারে নিজের কোড চালানো।
- 🔴 **টাকার বাগ:** ঋণাত্মক পরিমাণ দিয়ে অর্ডারের দাম কমানো যায়, ডেলিভারি চার্জ এড়ানো যায়, কাস্টমারের অর্ডারে stock কমে না (ORD-01 … ORD-06)।
- 🟠 কাস্টমার লগইন (OTP) কাজ করে না, কারণ SMS গেটওয়ে নেই। Wishlist ফিচার কখনো বানানোই হয়নি।
- 🟠 Laravel 9 EOL; dependency-তে ৯৩টা পরিচিত নিরাপত্তা সতর্কতা (২টা critical প্যাকেজ)।

**কাজের সংখ্যা:** P0 = ২১ (১২টা নিরাপত্তা + ৯টা অর্ডার) · P1 = ১৪ (৯টা frontend + ৫টা admin) · P2 = ৯ (প্ল্যাটফর্ম)। **মালিকের সিদ্ধান্ত লাগবে ১০টা জায়গায়** (নিচে "মালিকের সিদ্ধান্ত" অংশ)। কাজ শুরুর আগে ওগুলোর উত্তর দিলে এজেন্ট আটকাবে না।

---

## Executor এজেন্টের জন্য নিয়ম

1. **কাজের ক্রম:** P0-SEC → P0-ORD → P1 → P2। P0 শেষ না করে কোনো কিছু লাইভে নেবেন না।
2. **Branch:** প্রতিটা ধাপের জন্য আলাদা branch (`sec/…`, `ord/…`, `fe/…`), একটা কাজ = এক বা একাধিক ছোট commit, message-এ task ID (যেমন `SEC-06: scope account update to the logged-in user`)। **Push বা `main`-এ merge করবেন না**, রিপোর্টের পর মালিক সিদ্ধান্ত নেবেন।
3. **"মালিকের সিদ্ধান্ত" চিহ্নিত কাজ:** উত্তর না থাকলে নিরাপদ ডিফল্ট নিন (প্রতিটা কাজে লেখা আছে) আর রিপোর্টে স্পষ্ট লিখুন কোন ডিফল্ট নিয়েছেন।
4. **Production DB বা লাইভ সার্ভারে কিছু করবেন না।** সব কাজ local-এ।
5. [ui-fix-handoff.md](ui-fix-handoff.md)-র "নিয়ম" অংশ মানতে হবে (controller না পড়ে view না লেখা, Livewire syntax না, ব্যবসায়িক নিয়ম না বানানো, `priceFormate()`, `is_stock` একটা flag, ইত্যাদি)।
6. **প্রতিটা কাজ শেষে যাচাই** (নিচের command), আর প্রতিটা নিরাপত্তা/টাকার বাগের জন্য **একটা স্বয়ংক্রিয় টেস্ট** লিখবেন যেটা ফিক্সের আগে fail আর পরে pass করে।
7. কোনো কাজ সম্পূর্ণ না হলে "Done" লিখবেন না। "Partial" বা "Blocked" লিখে কারণ দেবেন।

### যাচাইয়ের command (প্রজেক্ট রুট থেকে)

```bash
php artisan view:clear && php artisan view:cache
npm run build
php tools/qa/crawl.php "$(pwd)" 157 1257          # সব GET route
php tools/qa/flow-test.php "$(pwd)" 157 246 1     # কেনাকাটার পুরো প্রবাহ (DB rollback হয়)
php tools/qa/js-check.php "$(pwd)" 157 246 1 storage/app/jscheck
php artisan test                                  # নতুন লেখা টেস্ট
composer audit
```

**বর্তমান baseline (c65bcf0):** view:cache ✅ · flow-test 37/37 ✅ · js-check ৫০টা script, ০ error ✅ · crawl: 105×200, 8×302, 2×404, **20×500 (সব admin, বিস্তারিত ADM-01/02)** · composer audit: **৯৩টা advisory / ১৮টা প্যাকেজ**।

---

## P0 — নিরাপত্তা (লাইভের আগে বাধ্যতামূলক)

### SEC-01 · পাবলিক seller রেজিস্ট্রেশন admin panel-এ ঢোকার অধিকার দেয় 🔴 Critical
- **প্রমাণ:** `Frontend\AuthController@sellerRegisterPost` নতুন ইউজারকে `assignRole('vendor')` আর `status=1` দেয়। `app/Http/Middleware/EnsureAdminAccess.php:21` `admin`, `worker` আর **`vendor`**-কে `/admin`-এ ঢুকতে দেয়। DB-তে vendor role-এর ১৩টা permission: product/category/purchase-এর create/edit/delete, `orderStatusUPdate`, `dashboard.access`। Route `/seller-register` সবার জন্য খোলা।
- **প্রভাব:** ইন্টারনেটের যে কেউ নিজে account বানিয়ে admin panel-এ ঢুকতে পারে, যেকোনো প্রোডাক্ট এডিট বা মুছতে পারে, অর্ডারের status বদলাতে পারে, আর SEC-02/03 মিলিয়ে সার্ভার দখল করতে পারে।
- **মালিকের সিদ্ধান্ত (D1):** marketplace-এর seller কি সত্যিই লাগবে? **ডিফল্ট: না** → `seller-register` আর `seller-register-post` route, method আর view মুছুন।
  - যদি লাগে: রেজিস্ট্রেশনে `status=0`, কোনো role না; admin অনুমোদন দিলে তবেই role; আর vendor-কে শুধু নিজের প্রোডাক্টে সীমাবদ্ধ করুন (প্রোডাক্টে `user_id` বা owner যোগ করে, প্রতিটা query-তে scope)।
- **এছাড়া:** `EnsureAdminAccess` থেকে `vendor` সরান, যতক্ষণ না scoping আছে। **ডেটা অডিট:** production DB-তে যাদের vendor role আছে তাদের তালিকা মালিককে দিন (local-এ ২জন)।
- **শেষের শর্ত:** নতুন seller রেজিস্ট্রেশন (চালু থাকলে) দিয়ে `/admin/*`-এ গেলে 403 বা redirect; টেস্ট লেখা আছে।

### SEC-02 · ৯টা admin controller-এ কোনো permission চেক নেই 🔴 Critical
- **প্রমাণ (permission-check / method):** `InformationController` 0/5 (Settings), `BanglaTextController` 0/5, `IPBlockController` 0/5, `ReportController` 0/5, `OrderPaymentController` 0/8, `LandingPageController` 0/9, `AboutUsController` 0/2। `admin.access` middleware পার হওয়া যেকোনো staff (worker/vendor) এগুলো ব্যবহার করতে পারে।
- **সমাধান:** প্রতিটা action-এ `can()` (বা route-এ `permission:` middleware)। যেখানে permission নেই সেখানে নতুন permission + seeder (যেমন `settings.edit`, `report.view`, `payment.manage`, `landing.manage`, `ipblock.manage`)। Settings শুধু `admin` role।
- **শেষের শর্ত:** worker আর vendor টেস্ট-ইউজার দিয়ে এই ৭টা controller-এর প্রতিটা route 403 দেয় (টেস্ট)। admin সব পারে।

### SEC-03 · অনিয়ন্ত্রিত ফাইল আপলোড → সার্ভারে কোড চালানো (RCE) 🔴 Critical
- **প্রমাণ:**
  - `app/Utils/Util.php` `uploadFile()` ফাইলের নাম দেয় `rand().'.'.$file->extension()`, যেটা content থেকে অনুমান করা extension। PHP ফাইল সেভ হবে `.php` নামে, `public/uploads/<folder>/`-এ।
  - `InformationController@update`: `site_logo`-তে শুধু `max:2048`, `favicon` আর `og_images`-এ কোনো validation নেই। Favicon-এর ফাইলনাম প্রতিটা পেজের `<head>`-এ দেখা যায়।
  - ১৩টা controller-এ ~২৭ জায়গায় `getClientOriginalExtension()`, মানে ব্যবহারকারীর দেওয়া extension: AboutUs, Career, Category, HomeSectionImage, LandingPage, Product (+ CKEditor `upload`), Slider, SocialIcon, Type। `image` rule শুধু content দেখে, তাই GIF header-ওয়ালা `shell.php` পার হয়ে যায়।
  - `public/` আর আপলোড ফোল্ডারে PHP চালানো বন্ধ করার কোনো `.htaccess` নেই।
  - (স্ক্যান অনুযায়ী এখন কোনো webshell নেই।)
- **সমাধান:**
  1. একটা কেন্দ্রীয় upload service বানান: validation `image|mimes:jpg,jpeg,png,webp,gif|max:<KB>` (SVG বাদ); নাম `Str::uuid().'.'.$ext`, যেখানে `$ext` শুধু whitelist থেকে, validated MIME অনুযায়ী। **ব্যবহারকারীর দেওয়া নাম বা extension কখনো ব্যবহার করবেন না।**
  2. ২৭টা জায়গা আর `Util::uploadFile` এই service দিয়ে বদলান। পুরনো ফাইলের পথ যেন না ভাঙে (DB-তে শুধু ফাইলনাম রাখা হয়, ফোল্ডার একই থাকবে)।
  3. প্রতিটা আপলোড ফোল্ডারে `.htaccess` দিন: PHP চালানো বন্ধ (`<FilesMatch "\.(php|phtml|phar|php\d)$"> Require all denied`), আর `public/.htaccess`-এ এই ফোল্ডারগুলোর জন্য একই নিয়ম। nginx-এ deploy হলে সমতুল্য নিয়মটা deploy doc-এ লিখুন।
- **শেষের শর্ত:** GIF-header দেওয়া `shell.php` (প্রোডাক্ট ছবি আর favicon হিসেবে) প্রত্যাখ্যাত হয় (টেস্ট)। আপলোড ফোল্ডারে কোনো `.php` থাকলেও HTTP অনুরোধে 403 আসে (XAMPP-এ হাতে যাচাই)। আগের আপলোড করা ছবিগুলো এখনো দেখায়।

### SEC-04 · Settings-এর script ফিল্ড পুরো সাইটে কাঁচা JS বসায় 🔴 High
- **প্রমাণ:** `tracking_code`, `pixel`, `search_console` validation ছাড়া সেভ হয় (`InformationController@update`), আর `{!! !!}` দিয়ে `frontend/partials/head.blade.php:53-55` আর `backend/landing_pages/land_page.blade.php:33`-এ রেন্ডার হয়। SEC-01 + SEC-02 মিলে মানে **যে কেউ পুরো storefront-এ নিজের JavaScript বসাতে পারে** (পাসওয়ার্ড বা পেমেন্ট তথ্য চুরি)।
- **সমাধান:** এগুলো ডিজাইনগতভাবেই script, তাই sanitize করা যাবে না। SEC-01/02-এর পর শুধু `admin` role-এর একটা আলাদা permission (`settings.scripts`) দিয়ে এডিট করা যাবে। পরিবর্তনের log রাখুন (কে, কখন)।
- **শেষের শর্ত:** admin ছাড়া কেউ এই ফিল্ড বদলাতে পারে না (টেস্ট)।

### SEC-05 · Courier API token (Pathao / RedX / Steadfast) Settings থেকে পড়া যায় 🔴 High
- **প্রমাণ:** `Backend\OrderController` constructor token পড়ে `informations` টেবিল থেকে (`redx_api_access_token`, `pathao_api_access_token`, `steadfast_api_key`, `steadfast_secret_key`), আর এগুলো Settings পেজে এডিট হয়, যেটার কোনো permission চেক নেই (SEC-02)।
- **সমাধান:** token-গুলো `.env` → `config/services.php`-এ নিন, অথবা DB-তে encrypt করে রাখুন আর UI-তে mask করে দেখান (শুধু নতুন মান লেখা যাবে, পুরনো পড়া যাবে না)।
- **মালিকের সিদ্ধান্ত (D9):** token-গুলো সম্ভবত উন্মুক্ত হয়ে গেছে, তাই courier-এর dashboard থেকে **rotate** করুন। ডিফল্ট: rotate করার সুপারিশ রিপোর্টে লিখুন।
- **শেষের শর্ত:** HTML-এর কোথাও token-এর মান নেই; courier parcel তৈরি এখনো কাজ করে (mock বা sandbox দিয়ে)।

### SEC-06 · যেকোনো কাস্টমার অন্য যেকোনো ইউজারের প্রোফাইল বদলাতে পারে → admin দখল 🔴 Critical
- **প্রমাণ:** `Frontend\UserAccountDetailsController@update(Request $request, $id)` করে `User::find($id)`, মালিকানা যাচাই ছাড়া। Route `Route::resource('account_details')` (`auth` middleware, তাই যেকোনো লগইন করা কাস্টমার)। আর OTP লগইন ইউজার খোঁজে `User::where('mobile', …)->first()` দিয়ে (SEC-07)।
- **আক্রমণ:** কাস্টমার `PUT /account_details/1` পাঠিয়ে admin-এর `mobile` বদলে নিজের নম্বর দেয় → নিজের নম্বরে OTP নেয় → admin হিসেবে লগইন করে। একই উপায়ে email বদলে password-reset পথও খোলে।
- **সমাধান:** `$id` উপেক্ষা করুন; সবসময় `auth()->user()`। একই controller-এর `show`/`edit`/`destroy`-ও দেখুন। `mobile`-কে unique আর সঠিক format-এ validate করুন।
- **শেষের শর্ত:** ইউজার A দিয়ে `PUT /account_details/{B-র id}` পাঠালে B-র কিছু বদলায় না (টেস্ট)।

### SEC-07 · কাস্টমার OTP লগইন staff/admin account-এও ঢুকিয়ে দেয় 🔴 High
- **প্রমাণ:** `Frontend\AuthController@optVerify`: মোবাইল মিলে গেলেই `Auth::loginUsingId($user->id)`, কোনো role যাচাই ছাড়া। ফলে staff account-এ শুধু ফোন নম্বর দিয়ে ঢোকা যায়, password লাগে না।
- **সমাধান:** frontend OTP লগইন শুধু staff role নেই এমন ইউজারের জন্য। staff মোবাইল দিলে "Staff accounts must sign in at /admin" দেখান। মোবাইল নম্বর একটা নির্দিষ্ট format-এ রাখুন।
- **শেষের শর্ত:** admin/worker/vendor-এর মোবাইল দিয়ে OTP লগইন প্রত্যাখ্যাত হয় (টেস্ট)।

### SEC-08 · OTP, পাসওয়ার্ড রিসেট আর অন্যান্য ফর্মে কোনো rate limit নেই 🔴 High
- **প্রমাণ:** `routes/web.php`-এ `user-login`, `otp-verify`, password-reset, `coupon-discount`, `contacts`, `newsletter`-এ `throttle` নেই। OTP ৬ ডিজিট, ৩ মিনিট বৈধ, ভুল চেষ্টার কোনো সীমা নেই। প্রতিটা `POST /user-login` একটা SMS পাঠায়।
- **প্রভাব:** OTP brute-force; যেকোনো নম্বরে SMS-বোমা আর আপনার SMS বিল বাড়ানো।
- **সমাধান:** OTP পাঠানো: ফোন+IP প্রতি ১ মিনিটে ১টা, ঘণ্টায় ৫টা। OTP যাচাই: প্রতি OTP-তে ৫ বার ভুল হলে বাতিল। OTP বানাতে `random_int`। contact/newsletter/coupon-এ সাধারণ `throttle`।
- **শেষের শর্ত:** ৬ষ্ঠ ভুল OTP-তে বাতিল; একই নম্বরে দ্রুত দ্বিতীয় অনুরোধে 429 (টেস্ট)।

### SEC-09 · ডেটা বদলানো ~১৭টা route GET দিয়ে চলে (CSRF) 🔴 High
- **প্রমাণ (`php artisan route:list --method=GET`):** `admin/all-order-delete`, `admin/order-status/{id}`, `admin/order-status-opdate`, `admin/multi-order-status-update-store`, `admin/assign-user-store`, `admin/create-{pathao,redx,steadfast}-parcel`, `admin/user-status-update`, `admin/recommended-update`, `admin/top-brand-update`, `admin/status-coupon`, `admin/Ip-block/delete/{id}`, `admin/file-delete/{id}`, `admin/delete-slider-image/{id}`, `admin/destroy-free-shipping`, `cart/clear-all`।
- **প্রভাব:** admin লগইন থাকা অবস্থায় কোনো ক্ষতিকর পেজ খুললে (যেমন `<img src=…/admin/all-order-delete?order_ids[]=…>`) অর্ডার মুছে যেতে বা status বদলে যেতে পারে।
- **সমাধান:** এগুলোকে POST/DELETE বানান, CSRF token দিন, আর সংশ্লিষ্ট JS/AJAX ও form বদলান। ইনপুট validate করুন (`order_ids => required|array`, ইত্যাদি)।
- **শেষের শর্ত:** এই route-এ GET পাঠালে 405; admin UI-তে প্রতিটা কাজ আগের মতো চলে (হাতে যাচাই করে তালিকা দিন)।

### SEC-10 · ব্যবহারহীন কিন্তু চালু অর্ডার endpoint 🔴 High
- **প্রমাণ:** `POST /store-data` (`CheckoutController@storeData`) ডেলিভারি চার্জ হিসাব করে কিন্তু `final_amount = sell_price` রাখে (চার্জ আর discount উপেক্ষা, পরিমাণ সবসময় ১)। `POST /store/checkout` (`StoreChk`)। কোনো view এদের ডাকে না। Live landing page ব্যবহার করে `front.storelandData`।
- **সমাধান:** দুটো route আর method মুছে ফেলুন (মালিক অন্য কোনো পুরনো landing page-এর কথা বললে আগে নিশ্চিত হন)।
- **শেষের শর্ত:** দুটো URL-এ 404/405; flow-test আর landing page অর্ডার আগের মতো চলে।

### SEC-11 · ভেতরের error কাস্টমারকে দেখানো 🟠 Medium
- **প্রমাণ:** `CheckoutController`-এর catch block JSON-এ `$e->getMessage()` ফেরত দেয় (কয়েক জায়গায়); `.env`-এ `APP_DEBUG=true`।
- **সমাধান:** `report($e)` + সাধারণ বার্তা ("Sorry, we couldn't place your order. Please try again.")। production `.env`-এর জন্য PLAT-06 দেখুন।

### SEC-12 · Dependency-র নিরাপত্তা সতর্কতা 🔴 High
- **প্রমাণ (`composer audit`):** ৯৩টা advisory, ১৮টা প্যাকেজে।
  - Critical: `laravel/framework` (৮টা), `phpoffice/phpspreadsheet` (৩১টা, `maatwebsite/excel`-এর মাধ্যমে)
  - High: `guzzlehttp/guzzle`, `league/commonmark`, `maatwebsite/excel`, `symfony/http-foundation`, `symfony/mime`, `symfony/process`, `symfony/yaml`, `phpunit`
  - npm: runtime-এ ০টা; dev-এ `axios` (high, এখন অব্যবহৃত) আর `esbuild`/vite (moderate)।
- **সমাধান:**
  1. আগে বর্তমান সীমার মধ্যে `composer update` (patch/minor), তারপর পুনরায় audit।
  2. Laravel 9-এর critical advisory সম্ভবত EOL হওয়ায় ঠিক হবে না → PLAT-01।
  3. `package.json` থেকে `axios`, `lodash` সরান (bundle আর ব্যবহার করে না); `vite` আর `laravel-vite-plugin` আপগ্রেড করুন।
- **শেষের শর্ত:** রিপোর্টে audit-এর আগে/পরে সংখ্যা, আর যা বাকি তার কারণ।

---

## P0 — টাকা ও অর্ডারের সঠিকতা

### ORD-01 · ঋণাত্মক বা অবৈধ পরিমাণ দিয়ে অর্ডারের দাম কমানো যায় 🔴 Critical
- **প্রমাণ:** `CartController@storeCart` আর `@store` শুধু `product_id`, `variation_id` validate করে; `quantity` না। `@edit` `$qty=$request->quantity` সরাসরি নেয়। `GET /carts/{id}/edit?quantity=-3`-এ লাইনের মোট ঋণাত্মক হয়, আর `CheckoutController@store` সেটা যোগ করে (`$total += qty*price`)।
- **সমাধান:** তিনটা endpoint-এ `quantity => required|integer|min:1|max:<যুক্তিসঙ্গত সীমা>` (edit-এ ০ = মুছে ফেলা চাইলে স্পষ্টভাবে আলাদা করুন)। Checkout-এ মোট হিসাবের আগে প্রতিটা কার্ট লাইন আবার যাচাই করুন (পূর্ণসংখ্যা ≥ ১, প্রোডাক্ট বা variation আছে)।
- **শেষের শর্ত:** ঋণাত্মক, ০, দশমিক আর বিশাল পরিমাণ প্রত্যাখ্যাত (টেস্ট); flow-test পাস।

### ORD-02 · Stock যাচাই ক্লায়েন্টের পাঠানো `is_stock`-এর উপর নির্ভর করে 🔴 High
- **প্রমাণ:** `CartController@storeCart`: `if($request->is_stock != 0) { stock check }`। ক্লায়েন্ট `is_stock=0` পাঠালে stock-এর সীমা উপেক্ষা হয়।
- **সমাধান:** `is_stock` সবসময় `Product` model থেকে পড়ুন। Form থেকে hidden `is_stock` সরানো ঐচ্ছিক।
- **শেষের শর্ত:** stock ট্র্যাক করা প্রোডাক্টে, `is_stock=0` পাঠিয়েও stock-এর বেশি যোগ করা যায় না (টেস্ট)।

### ORD-03 · Storefront অর্ডারে stock কমে না, কিন্তু বাতিল বা মুছলে বাড়ে 🔴 High
- **প্রমাণ:** `CheckoutController@store`-এ `decreaseProductStock` লাইন comment করা (~লাইন ৩৪৯)। অথচ admin-এর `OrderController@update`/`destroy`/`deleteAllOrder` বাতিল বা মুছলে `increaseProductStock` করে, আর admin-এর `store` কমায়। ফলে stock-এর সংখ্যা সময়ের সাথে ফুলে যাবে।
- **মালিকের সিদ্ধান্ত (D3):** stock কখন কমবে, অর্ডার দেওয়ার সময় নাকি admin confirm করলে? **ডিফল্ট: অর্ডার দেওয়ার সময়**, transaction-এর ভেতরে `lockForUpdate` দিয়ে আবার যাচাই করে।
- **সমাধান:** `store` আর `storelandData` দুটোতেই একই নিয়ম। বাতিল বা মুছলে ফেরত দেওয়ার নিয়মের সাথে মেলান (যেন দুবার ফেরত না হয়)।
- **শেষের শর্ত:** ট্র্যাক করা প্রোডাক্টে অর্ডার দিলে stock কমে, বাতিলে ফেরে, আবার বাতিলে আর বাড়ে না (টেস্ট)।

### ORD-04 · ডেলিভারি চার্জ এড়ানো যায় 🔴 High
- **প্রমাণ:** `CheckoutController@store`: `'delivery_charge_id' => 'required|numeric'`, তারপর `DeliveryCharge::find(...)`। `0` বা অস্তিত্বহীন id পাঠালে চার্জ ০। `storelandData`-তেও একই।
- **সমাধান:** কার্টে অন্তত একটা non-free-shipping আইটেম থাকলে `delivery_charge_id` অবশ্যই সক্রিয় `DeliveryCharge`-এর একটা হতে হবে (`exists` + status); `0` শুধু তখনই বৈধ যখন সব আইটেম free shipping।
- **শেষের শর্ত:** non-free কার্টে `delivery_charge_id=0` পাঠালে 422 (টেস্ট)।

### ORD-05 · Coupon-এর লজিক দুর্বল 🟠 Medium
- **প্রমাণ:** Session-এ শুধু coupon-এর পরিমাণ আর ধরন রাখা হয়; `CheckoutController@index` coupon খোঁজে `CouponCode::where('amount', $coupon)` দিয়ে (একই পরিমাণের একাধিক coupon থাকলে অস্পষ্ট)। ব্যবহারের কোনো সীমা নেই। minimum amount শুধু `index`-এ যাচাই হয়, `store`-এ না। fixed coupon subtotal-এর চেয়ে বড় হলে মোট ঋণাত্মক হয় (`final = total + charge − coupon`)।
- **মালিকের সিদ্ধান্ত (D4):** coupon প্রতি বা কাস্টমার প্রতি ব্যবহারের সীমা লাগবে কি? **ডিফল্ট: আপাতত সীমা নেই**, কিন্তু নিচের সঠিকতা ঠিক করা বাধ্যতামূলক।
- **সমাধান:** Session-এ coupon-এর `id` রাখুন; `store()`-এ তারিখ, minimum আর বৈধতা আবার যাচাই করুন; discount-কে `min(discount, subtotal)`-এ সীমিত করুন।
- **শেষের শর্ত:** মেয়াদোত্তীর্ণ বা minimum পূরণ না করা coupon `store`-এ বাতিল; মোট কখনো ঋণাত্মক হয় না (টেস্ট)।

### ORD-06 · Invoice নম্বর অনন্য না 🟠 Medium
- **প্রমাণ:** `invoice_no = rand(111111,999999)`, আর `orders.invoice_no`-তে কোনো unique index নেই (DB-তে শুধু PRIMARY)। প্রায় ১০০০ অর্ডারে একটা duplicate-এর সম্ভাবনা ~৪০%।
- **সমাধান:** অনন্য নম্বর বানান (যেমন তারিখ-ভিত্তিক ক্রমিক, অথবা সংঘর্ষ হলে আবার চেষ্টা) + migration দিয়ে unique index। তার আগে বিদ্যমান duplicate খুঁজে রিপোর্ট করুন।
- **শেষের শর্ত:** unique index আছে; একসাথে অনেক অর্ডার বানালেও duplicate হয় না (টেস্ট)।

### ORD-07 · গেস্ট checkout প্রতিবার নতুন User বানায় 🟠 Medium
- **প্রমাণ:** `CheckoutController@store` (আর অন্য অর্ডার পথ): গেস্ট হলে প্রতিবার `User::create([...])`, একই মোবাইল থাকলেও। অথচ OTP লগইন `->first()` নেয়, ফলে কাস্টমারের অর্ডার ইতিহাস ভাগ হয়ে যায়।
- **মালিকের সিদ্ধান্ত (D5):** একই মোবাইলের অর্ডার এক account-এ যাবে কি? **ডিফল্ট: হ্যাঁ** (মোবাইল normalize করে find-or-create; বিদ্যমান staff account-এ গেস্ট অর্ডার জুড়বেন না)।
- **শেষের শর্ত:** একই মোবাইলে দুটো গেস্ট অর্ডার → একটাই User (টেস্ট)। বিদ্যমান duplicate একত্র করার script ঐচ্ছিক (রিপোর্টে সংখ্যা দিন)।

### ORD-08 · কার্টে দাম স্থির থাকে 🟡 Low
- **প্রমাণ:** কার্টে যোগ করার সময়ের `price` session-এ থাকে, আর checkout সেটাই চার্জ করে। এর মধ্যে admin দাম বদলালেও পুরনো দামই নেওয়া হয়।
- **সমাধান:** কার্ট আর checkout দেখানোর সময় DB থেকে দাম আবার হিসাব করুন; বদলালে কাস্টমারকে জানান।

### ORD-09 · Landing page অর্ডারের টেস্ট নেই 🟡 Low
- `front.storelandData` (live): `final_amount = unit_price × qty + charge` (সঠিক বলে মনে হচ্ছে)। flow-test-এ একটা landing page অর্ডার যোগ করুন, আর ORD-01/03/04-এর নিয়ম এখানেও প্রয়োগ হয়েছে কিনা যাচাই করুন।

---

## P1 — কাস্টমারের দিকে কার্যকারিতা

### FE-01 · কাস্টমার লগইন (OTP) আর পাসওয়ার্ড রিসেট কাজ করে না 🔴 High
- **প্রমাণ:** `.env`-এ `SMS_*` খালি, তাই `SendSms()` `false` দেয়। `AuthController@login` (+ resend) সফলতা যাচাই করে `$res->Status == '0'` দিয়ে, যেটা পুরনো গেটওয়ের format। একই ধাঁচ `PasswordResetController`-এ ৩ জায়গায়।
- **মালিকের সিদ্ধান্ত (D2):** কোন SMS প্রোভাইডার (BulkSMSBD / Alpha Net / MIM ইত্যাদি)?
- **সমাধান:** `SendSms()` থেকে `bool` বা একটা স্পষ্ট result object ফেরত দিন, আর প্রোভাইডারের response পার্স করা ওখানেই হোক। ৫টা caller শুধু `true/false` দেখবে। প্রোভাইডার ঠিক না হওয়া পর্যন্ত লগইন পেজে স্পষ্ট বার্তা দেখান, "Something Went Wrong" না।
- **শেষের শর্ত:** fake SMS driver দিয়ে লগইন, OTP যাচাই আর রিসেট পুরো চলে (টেস্ট); আসল প্রোভাইডারের জন্য `.env` উদাহরণ।

### FE-02 · Wishlist ফিচার কখনো বানানোই হয়নি 🟠 Medium
- **প্রমাণ:** DB-তে wishlist-এর কোনো টেবিল নেই; `UserWishlistController@store` খালি (`//`); `index` কোনো ডেটা পাঠায় না; কোনো পেজ `wishlist.store` ডাকে না। তবুও menu, account sidebar আর product card-এ wishlist দেখায়।
- **মালিকের সিদ্ধান্ত (D7):** বানাবেন নাকি সরাবেন? **ডিফল্ট: সরান** (সব লিংক আর বোতাম; route রেখে দিলে 404 না দিয়ে redirect)।
- বানাতে চাইলে: migration + model + `store`/`destroy` (মালিকানা যাচাই সহ) + card আর প্রোডাক্ট পেজের বোতাম + wishlist পেজ।

### FE-03 · পেজের title-এ ব্র্যান্ড দুবার 🟡 Low
- **প্রমাণ:** `frontend/partials/head.blade.php:10` `@yield('title', …) — Modern Menswear` জোড়ে, আর view-গুলো "… — GENTRY" দেয়। ফলাফল: "Demo Product — GENTRY — Modern Menswear"।
- **সমাধান:** একটা নিয়ম ঠিক করুন (যেমন view শুধু পেজের নাম দেবে, layout জুড়বে `— {{ site_name }}`)।

### FE-04 · SEO-র মৌলিক জিনিস নেই 🟠 Medium
- **প্রমাণ:** `sitemap.xml` নেই; frontend-এ Open Graph, Twitter বা `ld+json` নেই (Settings-এ `og_images` ফিল্ড আছে কিন্তু কোথাও ব্যবহার হয় না); প্রোডাক্ট প্রতি meta description নেই।
- **সমাধান:** sitemap (প্রোডাক্ট, category, পেজ); OG ট্যাগ (প্রোডাক্টের ছবি আর দাম); প্রোডাক্টে `Product` structured data; canonical URL।

### FE-05 · Header, footer আর ১০টা পেজ এখনো পুরনো theme-এ 🟡 Low (ডিজাইন)
- **প্রমাণ:** header/footer partial, cart sidebar, categories, sub_categories, brands, dashboard, account_details, wishlists, otp_verify, seller_register, thank_you এখনো `axil-*` আর `mens.css` ব্যবহার করে। নতুন header/footer component অব্যবহৃত, আর তাদের SCSS `app.scss`-এ বন্ধ (class নামের সংঘর্ষের কারণে)।
- **সমাধান:** handoff doc-এর নিয়ম মেনে: header আর footer একসাথে একটা পরিবর্তনে বদলান (SCSS চালু + layout বদল), তারপর বাকি পেজ। পুরনো CSS ফাইল মুছবেন শুধু মেপে নিশ্চিত হয়ে যে কোনো রেন্ডার হওয়া template সেগুলো ব্যবহার করে না।

### FE-06 · অব্যবহৃত UI component 🟡 Low
- ১৪টা component কোথাও ব্যবহৃত হয় না (`c65bcf0`-এ যাচাই করা): header, footer, mobile-nav, drawer, modal, alert, checkbox, radio, skeleton, stock-badge, textarea, toast, variant-swatch-group, quick-view (`c076a08`-এ বদলানো হলেও কোনো পেজ এটা ব্যবহার করে না)। FE-05-এ লাগলে রাখুন, নইলে মুছুন। `components/admin/*` ADM-03-এর জন্য রাখুন।

### FE-07 · Policy আর FAQ-এর লেখা টেমপ্লেট থেকে আসা আর admin থেকে এডিট করা যায় না 🟠 Medium
- **প্রমাণ:**
  - `frontend/return_policy`, `privacy_policy`, `faq` hardcoded। এতে নির্দিষ্ট প্রতিশ্রুতি আছে: "ডেলিভারির ১৪ দিনের মধ্যে রিটার্ন", "৩–৫ কর্মদিবসে রিফান্ড", "৭ দিনের মধ্যে ত্রুটি জানান", "বিকাল ৩টার আগে অর্ডার করলে একই দিনে ডিসপ্যাচ", "শহরে ১–২ দিন, বাইরে ২–৪ দিন"। মালিক কখনো এগুলো নিশ্চিত করেননি।
  - Admin-এর "Pages" module-এ `return-policy` আর `about` (দুটো duplicate রেকর্ড) আছে, কিন্তু return/privacy পেজ সেগুলো পড়ে না। Terms আর about `$page` পড়ে।
  - অ-route করা ফাইলে Ralph Lauren-এর কপি করা লেখা (`frontend/protecting_our_brands/*`, `auth/signin.blade.php`)।
  - Settings-এ `site_name` = "Pallibazarbd"।
- **মালিকের সিদ্ধান্ত (D6):** আসল রিটার্ন, রিফান্ড, ডিসপ্যাচ আর ডেলিভারি নীতি কী?
- **সমাধান:** privacy/return/FAQ-কে `Page` model থেকে পড়ার মতো করুন (terms-এর মতো), বর্তমান লেখা DB-তে seed করুন যাতে মালিক এডিট করতে পারেন; duplicate `about` পরিষ্কার করুন; Ralph Lauren-এর ফাইল মুছুন। মালিক নীতি না দেওয়া পর্যন্ত প্রোডাক্ট পেজে কোনো নির্দিষ্ট প্রতিশ্রুতি দেখাবেন না।

### FE-08 · Frontend-এ অপ্রয়োজনীয় পুরনো asset 🟡 Low
- Bootstrap CSS/JS, অনেক jQuery plugin আর পুরনো theme CSS এখনো প্রতিটা পেজে লোড হয় (FE-05-এর পর ছাঁটাই করুন)। Lighthouse mobile performance মাপুন আর রিপোর্টে দিন।

### FE-09 · মানুষের চোখে দেখা QA (মালিক) 🟠 Medium
- আমি পেজ দেখতে পাই না। মালিক বা QA-কে ৩৬০/৭৬৮/১০২৪/১৪৪০ প্রস্থে দেখতে হবে: হোম (নতুন hero), শপ (মোবাইল ফিল্টার), প্রোডাক্ট (সাইজ বাছাই, ছবি বদল), কার্ট, checkout (বিকাশ ফিল্ড), অর্ডার, অর্ডার ডিটেইল, header/footer, admin-এর অর্ডার তালিকা। স্ক্রিনশট রিপোর্টে।

---

## P1 — Admin

### ADM-01 · ১১টা "create" পেজ 500 দেয় 🟠 Medium
- **প্রমাণ (crawl):** view নেই: `sliders`, `sizes`, `weights`, `colors`, `delivery-charges`, `coupon-codes`, `types`-এর create। method নেই: `categories`, `about_us`, `home-section-images`, `settings`-এর `create()`।
- **সমাধান:** প্রথমে দেখুন create কি index পেজের modal দিয়ে হয়। হলে frontend-এর মতো `create()` থেকে index-এ redirect করুন (অন্য এজেন্ট frontend-এ এটা করেছে); না হলে পেজ বানান।
- **শেষের শর্ত:** crawl-এ এই ১১টা route আর 500 দেয় না।

### ADM-02 · Parameter ছাড়া ডাকলে ৯টা admin endpoint 500 দেয় 🟡 Low
- `assign-user-store`, `multi-order-status-update-store`, `create-{pathao,redx,steadfast}-parcel`, `recommended-update`, `popular-category`, `top-brand-update`, `user-status-update`। SEC-09-এ POST বানানোর সময় validation দিন, যাতে খারাপ ইনপুটে 500 না হয়ে 422 আসে।

### ADM-03 · Admin redesign (আগে বাতিল করা হয়েছিল) 🟡 Low
- Admin এখন পুরনো theme-এ (ইচ্ছাকৃত)। নতুন করে করতে চাইলে প্রতিটা screen তার controller-এর `compact()` পড়ে, `components/admin/*` দিয়ে, এক screen করে, crawl দিয়ে যাচাই করে।

### ADM-04 · অকেজো ফাইল 🟡 Low
- ৩টা খালি Blade ফাইল (`backend/career/create`, `backend/product_discounts/show`, `backend/social_icons/create`)।
- `app/Http/Controllers/Backend/LandingPageSlider .php`: নামে space, তাই autoload হয় না। দেখে নিন ব্যবহৃত হয় কিনা, তারপর ঠিক করুন বা মুছুন।
- `HomeController@sendSMs` (খালি) আর `/send-sms` route মুছুন।

### ADM-05 · অর্ডার auto-assign সবসময় প্রথম worker-কে দেয় 🟡 Low
- **প্রমাণ:** `CheckoutController@store`-এ `role_id 8` hardcoded, আর সবসময় `$verified_users[0]`।
- **মালিকের সিদ্ধান্ত (D8):** কীভাবে ভাগ হবে (round-robin, সবচেয়ে কম কাজ যার, ইত্যাদি)? **ডিফল্ট:** role নাম (`worker`) দিয়ে খুঁজুন আর round-robin করুন।

---

## P2 — প্ল্যাটফর্ম, ডেটা ও অপারেশন

### PLAT-01 · Laravel 9 EOL 🔴 High (পরিকল্পিত)
- Laravel 9-এর নিরাপত্তা আপডেট ২০২৪-এর শুরুতে বন্ধ হয়েছে; SEC-12-এর critical advisory এর ফল।
- **মালিকের সিদ্ধান্ত (D10):** কখন আপগ্রেড হবে? **ডিফল্ট:** P0 আর PLAT-05 (টেস্ট) শেষ হওয়ার পর 9→10→11 ধাপে ধাপে, প্রতিটা ধাপে পুরো টেস্ট।

### PLAT-02 · নতুন সার্ভারে সাইট দাঁড় করানো যায় না 🟠 Medium
- **প্রমাণ:** ৩৪টা migration, অথচ DB-তে ৪৫টা টেবিল। ৯টা ব্যবসায়িক টেবিলের migration নেই: `informations`, `pages`, `coupon_codes`, `delivery_charges`, `landing_pages`, `landing_page_sliders`, `product_reviews`, `blocked_ips`, `bangla_text`। Role/permission (৫টা role, ৭৬টা permission), Settings-এর row আর ডেলিভারি চার্জের কোনো seeder নেই।
- **সমাধান:** বর্তমান schema থেকে migration বানান (`php artisan schema:dump` অথবা আলাদা migration), আর role, permission (SEC-02-এর নতুনগুলো সহ), Settings ও ডেমো ডেলিভারি চার্জের seeder লিখুন।
- **শেষের শর্ত:** খালি DB-তে `php artisan migrate:fresh --seed` → সাইট চলে, admin লগইন হয়, flow-test পাস।

### PLAT-03 · Index আর foreign key নেই 🟠 Medium
- **প্রমাণ:** `orders`, `order_details`, `products`, `variations`, `product_stocks`-এ PRIMARY ছাড়া কোনো index নেই; পুরো DB-তে মাত্র ৪টা FK।
- **সমাধান:** migration দিয়ে index: `orders(user_id)`, `orders(invoice_no)` (unique, ORD-06), `orders(status, created_at)`, `order_details(order_id)`, `order_details(product_id)`, `variations(product_id)`, `product_stocks(product_id, variation_id)`, `products(category_id)`। FK যোগ করুন শুধু orphan ডেটা পরিষ্কার করার পর (রিপোর্টে orphan-এর সংখ্যা)।

### PLAT-04 · Performance 🟡 Low (এখন) / বাড়বে
- **প্রমাণ (মাপা):** প্রতিটা পেজে `informations` টেবিলে **৬–৭টা একই query** (১৯টা ফাইল আলাদাভাবে `Information::first()`/`value()` ডাকে)। হোম পেজে ২৫টা query। শপের AJAX ১টা প্রোডাক্ট নিয়েও ~১.১ সেকেন্ড নিয়েছে (একবারের মাপ; বাস্তব ডেটায় আবার মাপুন)। লিস্টিং-এ প্রতিটা card-এর জন্য `category` lazy-load হয় (N+1)।
- **সমাধান:** Settings-কে একবার লোড করে cache করুন (singleton বা view composer, আপডেটে cache মুছে দিন); `ProductController@index` AJAX query-তে `with('category')`; প্রায় ১০০টা প্রোডাক্টের ডেটা দিয়ে query আর সময় মেপে রিপোর্ট দিন।

### PLAT-05 · কোনো আসল টেস্ট নেই 🟠 Medium
- **প্রমাণ:** `tests/`-এ শুধু Laravel-এর দুটো উদাহরণ (মোট ৭১ লাইন)।
- **সমাধান:** `tools/qa/flow-test.php` আর `crawl.php`-কে PHPUnit Feature test বানান (আলাদা টেস্ট DB, `RefreshDatabase`, PLAT-02-এর seeder), সাথে SEC/ORD-এর টেস্ট। GitHub Actions: `composer install`, `view:cache`, `php artisan test`, `composer audit`, `npm run build`।

### PLAT-06 · Production কনফিগ 🔴 High (deploy-এর দিন)
- **প্রমাণ (`.env`):** `APP_ENV=local`, `APP_DEBUG=true`, `LOG_LEVEL=debug`, `APP_URL=http://localhost`, `DB_USERNAME=root` আর পাসওয়ার্ড খালি, `MAIL_HOST=mailhog`, `SESSION_SECURE_COOKIE` নেই।
- **সমাধান:** `docs/deploy.md` লিখুন: production `.env`-এর উদাহরণ (debug false, আলাদা DB ইউজার আর শক্ত পাসওয়ার্ড, আসল mail, secure cookie, সঠিক `APP_URL`); document root `public/` (বর্তমান root `.htaccess` XAMPP-এ `.env`, dump আর `.git` ঠিকঠাক আটকায়, যাচাই করেছি, কিন্তু production-এ এর উপর নির্ভর করা ঠিক না); `storage:link`; `config:cache`, `route:cache`, `view:cache`; আপলোড ফোল্ডারের নিয়ম (SEC-03); ব্যাকআপ।

### PLAT-07 · প্রজেক্ট ফোল্ডারে database dump 🟠 Medium
- **প্রমাণ:** `updated-database.sql` (git-এ নেই ✓, XAMPP-এ HTTP দিয়ে পড়া যায় না ✓), কিন্তু এতে `users` টেবিলের ডেটা, ২টা bcrypt পাসওয়ার্ড hash আর ৫টা ফোন নম্বর আছে।
- **সমাধান:** প্রজেক্ট (web root) থেকে সরিয়ে নিরাপদ জায়গায় রাখুন। ডেমো ডেটা লাগলে PLAT-02-এর seeder ব্যবহার করুন।

### PLAT-08 · Repo পরিচ্ছন্নতা 🟡 Low
- `tools/qa/` রাখুন (PLAT-05-এ টেস্টে রূপান্তরিত হবে)। `storage/framework/views` untrack করা হয়েছে ✓। `.gitignore`-এ dump, log আর OS ফাইল নিশ্চিত করুন।

### PLAT-09 · আপলোড করা ছবির আকার 🟡 Low
- প্রোডাক্টের ছবি যেমন আপলোড হয় তেমনই পরিবেশন হয় (resize বা webp নেই)। SEC-03-এর upload service-এ resize/thumbnail যোগ করার কথা ভাবুন (ঐচ্ছিক; মালিককে আকার অনুযায়ী জানান)।

---

## ইতিমধ্যে ঠিক হয়েছে (আবার করবেন না)

যাচাই করা হয়েছে `c65bcf0`-এ:
- frontend-এর সব route-এ ০টা 500
- কেনাকাটার প্রবাহ ৩৭/৩৭; JS-এ ০ syntax error; Livewire বা Alpine-এর কোনো অবশেষ নেই
- প্রোডাক্ট পেজ: ছবির URL সঠিক, `gm-quick-add` form, `checkProductStock`, swatch-এর id বাগ ঠিক, বানানো প্রতিশ্রুতি আর "Save for later" সরানো, inline grid সরানো
- compiled view untrack; অব্যবহৃত `dashboard/index`, `dashboard/account`, `wishlist/index` মুছে ফেলা
- `variations.weight_id` migration (admin `get-order-product`-এর SQL error); `get_variation_price`; `show_prnt`
- frontend-এর `carts/create`, `checkouts/create`, `dashboard/create` → redirect
- confirmation পেজে মালিকানা যাচাই (`canViewOrder`)
- XAMPP-এ `.env`, dump, `.git`, `storage/logs` HTTP দিয়ে পড়া যায় না; `public/`-এ কোনো webshell নেই; কাস্টমারের দেওয়া ডেটা কাঁচা অবস্থায় রেন্ডার হয় না; request ইনপুট থেকে raw SQL নেই; CSRF-এর কোনো ব্যতিক্রম নেই

---

## মালিকের সিদ্ধান্ত (কাজ শুরুর আগে উত্তর দিন)

| # | প্রশ্ন | কোন কাজ | ডিফল্ট (উত্তর না দিলে) |
|---|---|---|---|
| D1 | Marketplace-এর বাইরের seller কি লাগবে? | SEC-01 | না, seller রেজিস্ট্রেশন মুছে ফেলা |
| D2 | কোন SMS প্রোভাইডার? | FE-01 | fake driver দিয়ে কাঠামো তৈরি, লগইনে স্পষ্ট বার্তা |
| D3 | Stock কখন কমবে? | ORD-03 | অর্ডার দেওয়ার সময় |
| D4 | Coupon-এর ব্যবহারের সীমা? | ORD-05 | আপাতত নেই |
| D5 | একই মোবাইলের গেস্ট অর্ডার এক account-এ? | ORD-07 | হ্যাঁ |
| D6 | আসল রিটার্ন/রিফান্ড/ডেলিভারি নীতি কী? | FE-07 | লেখা অপরিবর্তিত, শুধু admin থেকে এডিট-যোগ্য করা |
| D7 | Wishlist বানাবেন নাকি সরাবেন? | FE-02 | সরানো |
| D8 | অর্ডার কীভাবে worker-দের মধ্যে ভাগ হবে? | ADM-05 | round-robin |
| D9 | Courier token rotate করবেন? | SEC-05 | হ্যাঁ (মালিককে করতে হবে) |
| D10 | Laravel আপগ্রেড কখন? | PLAT-01 | P0 আর টেস্টের পরে |

---

## রিপোর্টের টেমপ্লেট (Executor → মালিক → Claude)

শেষে `docs/audit-report-<তারিখ>.md` নামে এই format-এ রিপোর্ট দিন:

```markdown
# Audit fix report — <date>
Branch(es): …   Base commit: c65bcf0   Head commit: …

## QA before → after
- view:cache: ✅/❌
- crawl: 105×200 / 20×500  →  …×200 / …×500   (list any NEW 500)
- flow-test: 37/37 → …/…   (list added checks)
- js-check: 50 scripts / 0 errors → …
- php artisan test: … tests, … assertions, … failures
- composer audit: 93 advisories / 18 packages → …

## Owner decisions used
- D1: <answer or "default: …">
- …

## Tasks
### SEC-01 — <Done | Partial | Blocked | Skipped>
- Commits: <sha> <message>
- Files: …
- What changed (2–3 lines): …
- Proof: <test name(s) that fail before / pass after; command output excerpt>
- Follow-ups / risks: …
(repeat for every task ID, in the order of this document)

## Things I could not verify
- …
```

**রিপোর্ট পাওয়ার পর আমি (Claude) যা করব:** প্রতিটা "Done" কাজের প্রমাণ নিজে আবার চালিয়ে দেখব (টেস্ট, crawl, flow-test, আর SEC-01/03/06-এর জন্য আক্রমণের পথ আবার চেষ্টা)। মিলে গেলে "Verified", না মিললে কারণসহ ফেরত।

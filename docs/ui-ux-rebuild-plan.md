# GENTRY UI/UX Rebuild — Full Plan (Option C)

**তারিখ:** 2026-11-19
**লাইভ ডক (কমেন্ট করা যায়):** https://claude.ai/artifact/VHtrAjVaEEQCB2WTjeR3cR

---

## এক নজরে

GENTRY-র পুরো UI — ৪৯টা frontend template আর ৯৬টা backend screen — একটা design system-এ আনতে **২৫–৩৫ working day** লাগবে, ৬টা phase-এ ভাগ করা।

এখন সাইটের কোনো স্টাইল সিস্টেম নেই। প্রতিটা পেজে ১৮টা stylesheet লোড হয়, একই component বারবার আলাদা ফাইলে রি-স্টাইল করা, আর ৪৩০+ `!important` দিয়ে জোর করে চাপানো। এজন্য একটা জিনিস ঠিক করলে আরেকটা ভাঙে — এটাই আসল সমস্যা, দেখতে খারাপ লাগাটা তার উপসর্গ।

প্ল্যানের মূল সিদ্ধান্ত চারটা:

- **Vite পাইপলাইন চালু করা।** ইতিমধ্যে ইনস্টল করা আছে কিন্তু কোথাও ব্যবহার হয় না — `@vite` কোনো ভিউতে নেই। এটাই সবচেয়ে বড় সুবিধা, নতুন কিছু কিনতে বা শিখতে হবে না।
- **Revenue path আগে।** Home → listing → product → cart → checkout. Phase 2 শেষেই (দিন ১০) আসল উন্নতি চোখে পড়বে।
- **Backend সবার শেষে।** ৯৬টা screen মোট কাজের ~৩৫%, কিন্তু সেল-এ প্রভাব শূন্য। তাই Phase 5।
- **PHP লজিক টাচ করা হবে না।** শুধু Blade markup আর CSS। অর্থাৎ অর্ডার, পেমেন্ট, স্টক — কিছুই ভাঙার ঝুঁকি নেই।

প্রতিটা phase শেষে সাইট deploy করার মতো অবস্থায় থাকবে। মাঝপথে থামলে যা হয়ে গেছে তা কাজ করবে, বাকিটা পুরনো স্টাইলে চলবে।

**শুরুর আগে ৪টা সিদ্ধান্ত লাগবে** — accent রং, Bootstrap রাখা হবে কিনা, backend theme বদলানো হবে কিনা, আর কে implement করবে। বিস্তারিত শেষ সেকশনে।

---

## এখনকার অবস্থা

মূল সমস্যা কুৎসিত ডিজাইন নয় — স্টাইলের কোনো কর্তৃপক্ষ নেই। যতবার কিছু বদলানো হয়েছে, নতুন ফাইল যোগ করে আগেরটা চাপা দেওয়া হয়েছে। নিচের সংখ্যাগুলো ২০২৬-১১-১৯ তারিখে কোডবেস স্ক্যান করে পাওয়া।

| কী পেলাম | সংখ্যা | কী সমস্যা তৈরি করে |
| --- | --- | --- |
| প্রতি পেজে stylesheet | 18টা (~770KB) | একটার উপর আরেকটা প্যাচ: base → style.min → header → update → newstyle → mens |
| কাস্টম CSS-এ `!important` | 430+ (শুধু mens.css-এ 159) | specificity war — নতুন স্টাইল লিখলে কাজ করে না |
| `.axil-product` ক্লাসটা রি-স্টাইল | 47 বার, ভিন্ন ফাইলে | একটা পেজে ঠিক করলে আরেক পেজে ভাঙে |
| `.axil-shop-sidebar` | 25 বার | উপরের একই সমস্যা |
| `style.css` + `style.min.css` | 372KB + 291KB | একই জিনিস দুইটা, একটা পুরোপুরি ডেড ওয়েট |
| Blade-এ inline `<style>` ব্লক | 37টা | স্টাইল কোথায় আছে খুঁজে পাওয়া যায় না |
| Blade-এ inline `style=""` | 345টা | একই, আর এগুলো CSS দিয়ে ওভাররাইড করা যায় না |
| `mens.css`-এ media query | 51KB-এ মাত্র 9টা | মোবাইল দুর্বল হওয়ার কথা |
| Vite বিল্ড আউটপুট | 225KB, কেউ লোড করে না | `@vite` কোনো ভিউতে নেই — পুরো পাইপলাইন অকেজো |
| Frontend template | 49টা | রিবিল্ডের স্কোপ |
| Backend screen | 96টা | এখানে 24টা inline `<style>` ব্লক + 176টা inline `style=""` |

কাজের দিক থেকে সবচেয়ে গুরুত্বপূর্ণ লাইন হলো Vite-এরটা। বিল্ড টুল আগেই কনফিগার করা আছে, শুধু কেউ সংযোগ করেনি — ফলে Phase 1-এ সেটআপে সময় নষ্ট হবে না।

---

## UI/UX ডিরেকশন

বর্তমান ডিরেকশনটা ফেলে দেওয়ার দরকার নেই। Bodoni Moda (display serif) + Jost (sans) + কালো-প্রধান প্যালেট — এটা editorial menswear-এর জন্য ঠিকই আছে, দুটো ফন্টই Google Fonts তাই লাইসেন্স ঝামেলা নেই। সমস্যা হলো এই ডিরেকশন কোথাও লেখা নেই, তাই প্রতিটা পেজে আলাদাভাবে ব্যাখ্যা হয়েছে।

নিচের ছয়টা প্রিন্সিপল পুরো রিবিল্ডের সিদ্ধান্ত ঠিক করবে। দ্বন্দ্ব লাগলে উপরেরটা জিতবে।

1. **পণ্য আগে, UI চুপ।** ছবি বড় আর পরিষ্কার হবে, চারপাশে বর্ডার-শ্যাডো-ব্যাজের ভিড় থাকবে না। একটা প্রোডাক্ট কার্ডে সর্বোচ্চ একটা ব্যাজ (Sale অথবা New, দুটো একসাথে নয়)।
2. **একটাই accent রং।** নিউট্রাল বেস (কালো, অফ-হোয়াইট, বালি রং) + একটিমাত্র accent। Sale লাল, CTA সবুজ, badge হলুদ — এই খিচুড়িই এখন সাইটটাকে সস্তা দেখাচ্ছে।
3. **Typography-ই সাজসজ্জা।** Display serif শুধু বড় heading আর hero-তে। বাকি সব Jost। অলংকার হিসেবে gradient, বাঁকা বর্ডার বা ড্রপ-শ্যাডো ব্যবহার হবে না।
4. **Mobile-first, কথার কথা নয়।** প্রতিটা component প্রথমে 360px-এ লেখা হবে, তারপর বড় স্ক্রিনে বাড়বে। বাংলাদেশে ই-কমার্স ট্রাফিকের বড় অংশ মোবাইল, তাই ডেস্কটপ ডিজাইন করে পরে চেপে বসানো হবে না।
5. **সুন্দরের আগে দ্রুত।** কোনো এফেক্ট যদি মোবাইলে LCP 2.5s-এর বেশি করে, সেটা বাদ। এখনকার 770KB CSS নামাতে হবে 120KB-এর নিচে (gzipped)।
6. **একটা জিনিস, এক জায়গায়।** প্রোডাক্ট কার্ড যদি বদলাতে হয়, একটাই ফাইল বদলাবেন — ৪৭ জায়গায় নয়।

### Backend-এর ডিরেকশন আলাদা

অ্যাডমিন প্যানেল সুন্দর হওয়ার দরকার নেই, **দ্রুত আর পরিষ্কার** হওয়া দরকার। যিনি দিনে ২০০টা অর্ডার প্রসেস করেন তাঁর চাই বেশি তথ্য এক স্ক্রিনে, স্পষ্ট status রং, আর কবে কোন বাটন কোথায় থাকবে তার ধারাবাহিকতা। তাই backend-এ নতুন থিম না বসিয়ে বর্তমান Hyper/app-creative থিমটাই রেখে শুধু প্যাটার্ন স্ট্যান্ডার্ডাইজ করা হবে — এতে ১০+ দিন বাঁচবে।

---

## Design tokens

এই ফাইলটাই পুরো সিস্টেমের ভিত্তি। `resources/scss/_tokens.scss`-এ বসবে, আর এর বাইরে কোনো ফাইলে hex রং, px সাইজ বা font-family সরাসরি লেখা যাবে না। এটাই একমাত্র নিয়ম যেটা মানলে পুরনো অবস্থায় ফিরে যাওয়া অসম্ভব হয়।

```css
:root{
  /* --- Neutral ramp (বেস) --- */
  --c-ink-900:#101010;   /* প্রধান টেক্সট, বাটন ব্যাকগ্রাউন্ড */
  --c-ink-700:#2E2C29;   /* সাব-হেডিং */
  --c-ink-500:#6E6963;   /* সেকেন্ডারি টেক্সট */
  --c-ink-300:#A8A29A;   /* placeholder, disabled */
  --c-line:#E3DED6;      /* বর্ডার, divider */
  --c-bg:#FFFFFF;        /* পেজ */
  --c-bg-2:#F8F6F3;      /* সেকশন, ইনপুট */
  --c-bg-3:#EFEAE3;      /* হোভার, skeleton */

  /* --- Accent (একটাই) --- */
  --c-accent:#8A6A45;        /* brass/tan — CTA, লিংক, সিলেক্টেড state */
  --c-accent-hover:#6F5436;
  --c-accent-ink:#FFFFFF;    /* accent-এর উপরের টেক্সট */

  /* --- Status (শুধু feedback-এ, সাজসজ্জায় নয়) --- */
  --c-success:#1F7A4D; --c-success-bg:#E8F3ED;
  --c-warn:#9A6400;    --c-warn-bg:#FCF2E0;
  --c-danger:#B3261E;  --c-danger-bg:#FBEAE9;
  --c-info:#1F5FA6;    --c-info-bg:#E8F0F9;

  /* --- Typography --- */
  --f-display:'Bodoni Moda', Georgia, serif;
  --f-body:'Jost', system-ui, -apple-system, sans-serif;
  --t-xs:0.75rem;    /* 12 — badge, caption */
  --t-sm:0.875rem;   /* 14 — meta, label */
  --t-md:1rem;       /* 16 — body (মোবাইলে এর নিচে নামানো যাবে না) */
  --t-lg:1.25rem;    /* 20 — প্রোডাক্ট নাম */
  --t-xl:1.5rem;     /* 24 */
  --t-2xl:2rem;      /* 32 — সেকশন heading */
  --t-3xl:2.75rem;   /* 44 — hero (মোবাইলে clamp হবে) */
  --lh-tight:1.15; --lh-base:1.55; --lh-loose:1.7;
  --ls-wide:0.08em;  /* ছোট ক্যাপস লেবেল */

  /* --- Space (4px base) --- */
  --s-1:4px;  --s-2:8px;  --s-3:12px; --s-4:16px;
  --s-5:24px; --s-6:32px; --s-7:48px; --s-8:64px; --s-9:96px;

  /* --- Radius (মাপা, menswear-এ গোল কম) --- */
  --r-sm:2px; --r-md:4px; --r-lg:8px; --r-full:999px;

  /* --- Elevation (তিনটাই, এর বেশি নয়) --- */
  --sh-1:0 1px 2px rgba(16,16,16,.06);
  --sh-2:0 4px 16px rgba(16,16,16,.08);
  --sh-3:0 12px 32px rgba(16,16,16,.12);

  /* --- Motion --- */
  --d-fast:120ms; --d-base:200ms; --d-slow:320ms;
  --e-out:cubic-bezier(.22,.61,.36,1);

  /* --- Layout --- */
  --container:1280px; --gutter:16px; --gutter-lg:32px;
  --header-h:64px; --header-h-lg:88px;
}
```

### Breakpoint

পাঁচটাই, এর বাইরে কোনো media query লেখা যাবে না। এখন যেখানে মানহীন বিভিন্ন ব্রেকপয়েন্ট ছড়ানো, সেটাই মোবাইল লেআউট ভাঙার মূল কারণ।

| নাম | মিন ওয়িথ | কী ধরে |
| --- | --- | --- |
| (ডিফল্ট) | 0 | ছোট ফোন, 360px ধরে লেখা |
| `sm` | 480px | বড় ফোন |
| `md` | 768px | ট্যাবলেট — প্রোডাক্ট গ্রিড 2→3 কলাম |
| `lg` | 1024px | ল্যাপটপ — সাইডবার দৃশ্যমান, মেগা মেনু চালু |
| `xl` | 1280px | ডেস্কটপ — container পূর্ণ প্রস্থ |

Dark mode এই স্কোপে নেই। স্টোরফ্রন্টে এর চাহিদা কম, আর পরে যোগ করতে চাইলে টোকেন সিস্টেম আগে থাকলে সেটা ২ দিনের কাজ।

---

## Component library

৮১টা ফ্রন্টএন্ড component বানালে ৪৯টা template-এর পুরো UI ঢেকে যায়। প্রতিটা Blade component হবে (`resources/views/components/ui/`), যাতে markup আর স্টাইল একসাথে এক জায়গায় থাকে।

### Foundation (14টা)

| Component | Variant | State |
| --- | --- | --- |
| Button | primary, secondary, ghost, danger / sm, md, lg | hover, active, focus-visible, disabled, loading |
| Input, Textarea | default, with-icon | focus, error, disabled, readonly |
| Select | native, custom | উপরের মতো |
| Checkbox, Radio | default | checked, indeterminate, error |
| Badge | neutral, sale, new, stock, status | — |
| Chip / Tag | filter, removable | selected |
| Alert | info, success, warn, danger | dismissible |
| Toast | উপরের চারটা | enter, exit |
| Modal | sm, md, lg, fullscreen-mobile | open, closing |
| Drawer | right (cart), left (mobile nav), bottom (filter) | open |
| Tabs | underline, pill | active, disabled |
| Accordion | single, multi | open |
| Breadcrumb, Pagination | — | current, disabled |
| Skeleton | text, box, card | — |

### Commerce (12টা)

| Component | কোথায় লাগবে | খেয়াল |
| --- | --- | --- |
| Product card | home, listing, related, combo, wishlist | একটাই ফাইল — এখন 47 জায়গায় ছড়ানো |
| Price | card, PDP, cart | ডিসকাউন্ট হলে পুরনো দাম strike + শতকরা |
| Variant swatch | PDP, quick view | color (গোল), size (বক্স); out-of-stock ধূসর |
| Quantity stepper | PDP, cart, drawer | স্টক লিমিট মানবে |
| Gallery | PDP | thumbnail + zoom; মোবাইলে swipe |
| Rating | card, PDP, review | রিভিউ সংখ্যা সহ |
| Stock badge | card, PDP | in / low / out — তিনটাই |
| Wishlist button | card, PDP | লগইন না থাকলে প্রম্পট |
| Cart line | cart page, drawer | মোবাইলে স্ট্যাক, ডেস্কটপে রো |
| Order summary | cart, checkout | subtotal, discount, delivery, total |
| Filter sidebar | listing, category | ডেস্কটপে সাইডবার, মোবাইলে bottom drawer |
| Empty state | cart, wishlist, order, search | আইকন + এক লাইন + CTA |

### Layout (6টা)

Header (sticky, scroll-এ ছোট হয়), Mega menu, Mobile nav drawer, Footer, Section header (title + লিংক), Container/Grid।

### Backend-এর জন্য আলাদা 8টা

Data table (sort, sticky header), Filter bar, Form row (label + input + error), Image uploader, Save bar (sticky), Stat card, Status pill, Page header (title + breadcrumb + action)। এই ৮টাই ৯৬টা admin screen-এর প্রায় সব ধরে ফেলবে।

---

## Technical architecture

মূল কৌশল: পুরনো CSS একসাথে ফেলা হবে না। নতুন সিস্টেম পাশে বসবে, পেজ ধরে ধরে পুরনোটার অংশ কাটা যাবে, আর শেষ পেজটা হয়ে গেলে `legacy.css` ডিলিট হবে। এতে প্রতিটা দিন শেষে সাইট চালু থাকে।

### ফাইল স্ট্রাকচার

```
resources/
  scss/
    _tokens.scss        ← একমাত্র জায়গা যেখানে hex/px লেখা যায়
    _reset.scss
    _base.scss          ← html, body, heading, link, form reset
    _utilities.scss     ← হাতেগোনা: .u-stack, .u-row, .u-container
    components/         ← প্রতিটা component একটা ফাইল
      _button.scss  _product-card.scss  _drawer.scss ...
    pages/              ← শুধু যা কোনো component-এ ফেলা যায় না
      _home.scss  _pdp.scss  _checkout.scss
    app.scss            ← সব @use করে, এই ক্রমে
    admin.scss          ← backend-এর আলাদা bundle
  views/components/ui/  ← Blade component (markup)
public/frontend/css/
  legacy.css            ← পুরনো 7টা ফাইল একে মিলিয়ে, শুধু কমানোর জন্য
```

### লোড ক্রম (এই ক্রমটাই `!important` অপ্রয়োজনীয় করে)

1. `legacy.css` — সবার আগে, সবচেয়ে দুর্বল
2. `app.css` (Vite build) — tokens → reset → base → components → pages → utilities
3. কোনো inline `<style>` নয়, কোনো `style=""` নয়

এখন উল্টো চলছে — নতুন স্টাইল আগে লোড হয়, তাই জোর করতে `!important` লাগে। ক্রম ঠিক হলে সমস্যাটাই থাকে না।

### Naming

সরল BEM: `.block__element--modifier`। নতুন সব ক্লাস `gm-` prefix নেবে (`gm-card`, `gm-btn`) — এতে এক নজরে বোঝা যাবে কোনটা নতুন আর কোনটা পুরনো `.axil-*`, আর শেষে খুঁজে বাকি পুরনোটা মুছতে সুবিধা হবে।

### Bootstrap-এর সিদ্ধান্ত

সুপারিশ: **frontend থেকে Bootstrap বাদ, backend-এ রাখা।** স্টোরফ্রন্টে এর গ্রিড আর কমপোনেন্ট দুটোই ওভাররাইড করতে হচ্ছে, CSS Grid দিয়ে কম কোডে ভালো হবে। কিন্তু backend-এর ৯৬টা screen Bootstrap-এর গ্রিডে বসানো — সেখানে সরালে ১০+ দিন অতিরিক্ত লাগবে, লাভ নেই।

### Vite চালু করা

`vite.config.js`-এ `app.scss` আর `admin.scss` input হিসেবে যোগ, তারপর দুটো layout-এ `@vite([...])` বসানো। এতে পাওয়া যাবে hot reload (রিফ্রেশ ছাড়া স্টাইল পরিবর্তন), আর cache-busting hash — যেটার অভাবে এখন `header.css?v=007` লিখে হাতে ভার্সন বাড়ানো হচ্ছে।

---

## Frontend rebuild

৪৯টা template ছয় গ্রুপে ভাগ করা। ক্রমটা টাকার রাস্তা অনুযায়ী — যে পেজ বেশি মানুষ দেখে আর সেল-এ সরাসরি প্রভাব ফেলে, সেটা আগে।

| # | গ্রুপ | Template | দিন | কী হবে |
| --- | --- | --- | --- | --- |
| 1 | Revenue path | 5 | 5 | Home, listing, PDP, cart, checkout — পুরো নতুন markup + component |
| 2 | Shared partials | 5 | 2 | Header, mega menu, mobile nav, footer, cart drawer |
| 3 | Account | 7 | 3 | লগইন, রেজিস্টার, ড্যাশবোর্ড, অর্ডার লিস্ট + ডিটেইল, অ্যাকাউন্ট, উইশলিস্ট |
| 4 | Catalog secondary | 8 | 3 | Category, sub-category, brands, discount, combo, free-shipping, landing page, quick view |
| 5 | CMS পেজ | 10 | 2 | About, career, contact, FAQ, privacy, return, terms — একটাই prose layout |
| 6 | Dead template | 14 | 1 | যাচাই করে ডিলিট |

### গ্রুপ 6 সম্পর্কে

`app2.blade.php`, `old_show.blade.php`, `old-show.blade.php`, `index_data.blade.php`, `free_shipping_data.blade.php` — এগুলো পুরনো ভার্সন বলে মনে হচ্ছে। প্রতিটা মুছার আগে route আর `@include` খুঁজে নিশ্চিত হতে হবে কেউ ডাকে কিনা। এক দিনের কাজ, কিন্তু পরবর্তী সব কাজ হালকা করে দেবে।

### প্রতিটা পেজে যে কাজগুলো হবে

একই চার ধাপ, প্রতিটা পেজে:

1. পুরনো markup পড়ে কোন component লাগবে ঠিক করা
2. Blade component দিয়ে markup পুনর্লেখা, inline `style=""` সরানো
3. `pages/_<page>.scss`-এ শুধু যা component-এ ফেলা যায় না
4. `legacy.css` থেকে এই পেজের নিয়মগুলো কাটা, তারপর চার ব্রেকপয়েন্টে যাচাই

চেকআউট পেজটা সবচেয়ে সাবধানে করতে হবে। এর ব্লেডে JavaScript এবং ফর্ম ফিল্ডের `name` এর সঙ্গে `CheckoutController`-এর সরাসরি সম্পর্ক আছে — ক্লাস বদলানো যাবে, কিন্তু `name`, `id` আর JS হুক অপরিবর্তিত রাখতে হবে।

---

## Backend admin rebuild

৯৬টা screen শুনলে ভয় লাগে, কিন্তু এগুলো মূলত **পাঁচটা প্যাটার্নের** পুনরাবৃত্তি। প্যাটার্নটা একবার ঠিক করলে বাকি screen গুলোতে শুধু বসানোর কাজ — স্ক্রিনপ্রতি গড়ে ১৫–২০ মিনিট।

| প্যাটার্ন | আনুমানিক screen | কী স্ট্যান্ডার্ডাইজ হবে |
| --- | --- | --- |
| List / index | 32 | Page header, filter bar, data table, pagination, bulk action, empty state |
| Create / edit form | 34 | Field grid, label, help text, error, image uploader, sticky save bar |
| Detail / show | 12 | Order ও purchase ডিটেইল, ইনভয়েস, প্রিন্ট ভিউ |
| Dashboard / report | 9 | Stat card, চার্ট কন্টেইনার, date-range ফিল্টার, export বাটন |
| Auth ও বিবিধ | 9 | লগইন, পারমিশন, রোল, সেটিংস |

### তিনটা নির্দিষ্ট কাজ

1. **২৪টা inline `<style>` ব্লক সরানো।** এগুলো এখন প্রতিটা পেজে আলাদা টেবিল স্টাইল লিখছে, ফলে একই টেবিল পাঁচ রকম দেখায়। সব `admin.scss`-এ যাবে।
2. **৮টা Blade component বানানো** (আগের সেকশনে তালিকা)। যেমন `<x-admin.table>` এবং `<x-admin.page-header>`।
3. **Status রং এক করা।** অর্ডার status (pending / processing / on the way / on hold / complete / cancelled) এখন ভিন্ন পেজে ভিন্ন রঙে। একটাই ম্যাপিং হবে, আর `getOrderStatus()` helper-এর সঙ্গে মিলিয়ে রাখা হবে।

### যা করা হবে না

নতুন অ্যাডমিন থিম কেনা বা Hyper সরানো হবে না, Bootstrap-ও সরানো হবে না। এতে অতিরিক্ত ১০–১৫ দিন লাগত, আর ব্যবহারকারী শুধু আপনি আর আপনার স্টাফ — লাভ নেই। লক্ষ্য হলো ধারাবাহিকতা আনা, নতুন চেহারা নয়।

---

## Phase ও timeline

| Phase | দিন | ডেলিভারি | এখানে থামলে |
| --- | --- | --- | --- |
| 1 · ভিত্তি | দিন 1–5 | Vite চালু, token ফাইল, 14টা foundation component, 7টা পুরনো CSS একে মিলিয়ে `legacy.css` | চেহারা একই, কিন্তু ভিত্তি পরিষ্কার |
| 2 · Revenue path | দিন 6–10 | Home, listing, PDP, cart, checkout + header, footer, cart drawer | দোকানের মূল অংশ নতুন — এখানে থামাও গ্রহণযোগ্য |
| 3 · Account + catalog | দিন 11–15 | লগইন, ড্যাশবোর্ড, অর্ডার, উইশলিস্ট, category, brands, combo — 15টা template | পুরো কাস্টমার-মুখী অংশ নতুন |
| 4 · CMS + cleanup | দিন 16–19 | 10টা CMS পেজ, 14টা dead template মুছে ফেলা, `legacy.css` ডিলিট | ফ্রন্টএন্ড সম্পূর্ণ, CSS 770KB থেকে ~110KB |
| 5 · Backend | দিন 20–29 | 96 screen 5টা প্যাটার্নে, 8টা admin component, status রং এক | অ্যাডমিনও ধারাবাহিক |
| 6 · QA + launch | দিন 30–32 | চার ব্রেকপয়েন্ট, চার ব্রাউজার, Lighthouse, পূর্ণ অর্ডার টেস্ট | লাইভ |

**মোট ৩২ working day।** Phase 5 একাই ১০ দিন — পুরো কাজের এক-তৃতীয়াংশ অ্যাডমিন প্যানেলে। এজন্যেই সেটা শেষে: বাজেট বা সময় ফুরিয়ে গেলে যে অংশটা বাদ পড়লে সেল-এ কোনো ক্ষতি নেই।

একজন ফুল-টাইম ডেভেলপার ধরে হিসাব। নতুন ফিচার যোগ হলে বা পণ্যের ছবি নতুন করে তুলতে হলে এর বাইরে সময় ধরতে হবে।

---

## Definition of Done

একটা পেজ "হয়ে গেছে" বলা যাবে কেবল নিচের সবগুলো পাস করলে। এটাই একমাত্র রক্ষাকবচ যেটা ছয় মাস পর আবার একই অবস্থায় ফিরে যাওয়া ঠেকাবে।

**লেআউট**

- [ ] 360, 768, 1024, 1440 — চার প্রস্থে পরীক্ষিত
- [ ] কোনও horizontal scroll নেই
- [ ] ছবিতে width/height দেওয়া আছে (layout shift রোধে)

**কোড**

- [ ] এই পেজে কোনো inline `style=""` নেই
- [ ] এই পেজে কোনো নতুন `!important` নেই
- [ ] সব রং/সাইজ token থেকে, হার্ডকোড নয়
- [ ] `legacy.css` থেকে এই পেজের নিয়ম কাটা হয়েছে

**Accessibility**

- [ ] টেক্সট contrast ন্যূনতম 4.5:1
- [ ] কীবোর্ড দিয়ে পুরো পেজ চালানো যায়, focus দৃশ্যমান
- [ ] ছবিতে alt, বাটনে স্পষ্ট লেবেল
- [ ] টাপ টার্গেট ন্যূনতম 44x44px

**Performance**

- [ ] মোবাইলে Lighthouse performance 90+
- [ ] CSS মোট 120KB-এর কম (gzipped)
- [ ] LCP 2.5s-এর কম (4G থ্রটলিং)

**ব্রাউজার**

- [ ] Chrome, Firefox, Safari (iOS 15+), Samsung Internet

শেষ তিনটা সবচেয়ে গুরুত্বপূর্ণ: Samsung Internet বাংলাদেশে উল্লেখযোগ্য শেয়ার রাখে, আর iOS Safari-তে আধুনিক CSS সবসময় একরকম আচরণ করে না।

---

## ঝুঁকি, নিয়ম ও সিদ্ধান্ত

### পাঁচটা নিয়ম

1. **PHP লজিক টাচ না।** Controller, model, route অপরিবর্তিত। শুধু Blade markup আর CSS।
2. **ফর্ম ফিল্ডের `name` আর JS হুক অপরিবর্তিত।** ক্লাস বদলানো যাবে, কিন্তু `cart.js`, `checkout.js`, `ajax.js` যে সব selector খোঁজে সেগুলো আগে ম্যাপ করে নিতে হবে।
3. **এক phase = এক branch।** মার্জ হবে কেবল Definition of Done পাস করলে।
4. **প্রতিটা phase শেষে deploy।** ছয় সপ্তাহের কাজ একসাথে লাইভে তোলা হবে না।
5. **`legacy.css` শেষে মুছবে।** আগে নয়। এটাই ফিরে যাওয়ার রাস্তা খোলা রাখে।

### ঝুঁকি

| ঝুঁকি | সম্ভাবনা | কী করব |
| --- | --- | --- |
| Checkout ভেঙে অর্ডার বন্ধ হওয়া | কম, কিন্তু ক্ষতি সবচেয়ে বেশি | লাইভে তোলার আগে তিনটা পূর্ণ অর্ডার টেস্ট (COD, bKash, Stripe) |
| পুরনো CSS মুছতে গিয়ে অন্য পেজ ভাঙা | মাঝারি | একসাথে না মুছে পেজ ধরে ধরে; `gm-` prefix দিয়ে নতুন-পুরনো আলাদা রাখা |
| অ্যাডমিন প্যানেলে কাজ আটকে যাওয়া | মাঝারি | Phase 5 সবার শেষে; এক সাথে সব screen না, প্যাটার্ন ধরে ধরে |
| মাঝপথে স্কোপ বাড়া | বেশি | নতুন ফিচারের আবদার আলাদা তালিকায়, এই প্রজেক্টে নয় |
| পুরনো ছবির মান খারাপ | বেশি | নতুন ডিজাইন বড় ছবি চায়; পণ্যের ছবি নতুন করে তোলা লাগতে পারে — এটা এই ম্যান-ডে হিসাবে ধরা নেই |

### Rollback

প্রতিটা phase ডিপ্লয় করার আগে git tag। সমস্যা হলে `git revert` + আগের `public/build` ফোল্ডার ফিরিয়ে আনা — ২ মিনিটের কাজ। DB-তে কোনো পরিবর্তন নেই বলে ডাটা হারানোর ঝুঁকি শূন্য।

### শুরুর আগে চারটা সিদ্ধান্ত

- [ ] **Accent রং।** প্রস্তাব `#8A6A45` (brass/tan)। ব্র্যান্ডের নির্দিষ্ট রং থাকলে জানান।
- [ ] **Frontend থেকে Bootstrap বাদ দেওয়া হবে কিনা।** সুপারিশ: হ্যাঁ।
- [ ] **Backend থিম রাখা হবে কিনা।** সুপারিশ: হ্যাঁ, শুধু প্যাটার্ন ঠিক হবে।
- [ ] **কে implement করবে।** আমি করলে এই হিসাব; অন্য ডেভেলপার হলে এই ডকই স্পেক হিসেবে দেওয়া যাবে।

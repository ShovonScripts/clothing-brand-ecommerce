/**
 * Frontend entry, loaded on every storefront page via @vite in
 * frontend/partials/head.blade.php.
 *
 * Do NOT import Bootstrap here: frontend/partials/js.blade.php already loads
 * public/frontend/js/vendor/bootstrap.min.js globally, and a second copy makes
 * every data-bs-toggle element toggle twice (open, then immediately close).
 * jQuery, toastr and sweetalert are also loaded globally by that partial.
 */
import './ui';

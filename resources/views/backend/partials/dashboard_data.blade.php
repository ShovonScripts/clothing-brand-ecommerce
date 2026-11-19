<div class="row g-3">
    <div class="col-md-6 col-xl-3">
        <a href="{{ url('admin/products') }}" class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #15bf81 0%, #10a871 100%);">
                <i class="mdi mdi-package-variant"></i>
            </div>
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ number_format($products ?? 0) }}</div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="{{ url('admin/orders') }}" class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <i class="mdi mdi-cart-outline"></i>
            </div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ number_format($orders ?? 0) }}</div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="{{ url('admin/users') }}" class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="mdi mdi-account-group"></i>
            </div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ number_format($users ?? 0) }}</div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <i class="mdi mdi-currency-bdt"></i>
            </div>
            <div class="stat-label">Today's Sales</div>
            <div class="stat-value">৳ {{ number_format($today_sell ?? 0, 2) }}</div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.settings.index') }}" class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                <i class="mdi mdi-cog-outline"></i>
            </div>
            <div class="stat-label">Site Settings</div>
            <div class="stat-value">Configure</div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="{{ url('admin/order-report') }}" class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
                <i class="mdi mdi-file-chart-outline"></i>
            </div>
            <div class="stat-label">Reports</div>
            <div class="stat-value">View All</div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                <i class="mdi mdi-calendar-month-outline"></i>
            </div>
            <div class="stat-label">This Month</div>
            <div class="stat-value">৳ {{ number_format($current_month_sell ?? 0, 2) }}</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div class="icon-box" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                <i class="mdi mdi-calendar-outline"></i>
            </div>
            <div class="stat-label">Last Month</div>
            <div class="stat-value">৳ {{ number_format($prev_month_sell ?? 0, 2) }}</div>
        </div>
    </div>
</div>
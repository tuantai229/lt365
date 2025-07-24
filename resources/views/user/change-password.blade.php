@extends('user.layouts.app')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-6">Đổi mật khẩu</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.change-password.post') }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu hiện tại</label>
                <input type="password" id="current_password" name="current_password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu mới</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu mới</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-primary text-white py-2 px-6 rounded-lg font-medium hover:bg-primary/90 transition-colors duration-200">
                    Cập nhật mật khẩu
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

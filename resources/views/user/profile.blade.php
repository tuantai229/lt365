@extends('user.layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-4 mb-6">Hồ sơ cá nhân</h1>

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

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" x-data="{ avatarPreview: '{{ $user->avatar_url }}' }">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Avatar Section -->
            <div class="md:col-span-1 flex flex-col items-center">
                <template x-if="avatarPreview">
                    <img :src="avatarPreview" alt="Avatar" class="w-40 h-40 rounded-full object-cover mb-4 border-4 border-gray-200">
                </template>
                <input type="file" name="avatar" id="avatar" class="hidden" 
                       @change="avatarPreview = URL.createObjectURL($event.target.files[0])">
                <label for="avatar" class="cursor-pointer bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-lg text-sm font-medium hover:bg-gray-50">
                    Thay đổi ảnh đại diện
                </label>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG. Tối đa 2MB.</p>
            </div>

            <!-- Info Section -->
            <div class="md:col-span-2 space-y-6">
                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>

                <!-- Email (Read-only) -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" readonly
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Ngày sinh</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                    </div>
                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Giới tính</label>
                        <select id="gender" name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Chọn giới tính</option>
                            <option value="male" @selected(old('gender', $user->gender) == 'male')>Nam</option>
                            <option value="female" @selected(old('gender', $user->gender) == 'female')>Nữ</option>
                            <option value="other" @selected(old('gender', $user->gender) == 'other')>Khác</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                    <textarea id="address" name="address" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">{{ old('address', $user->address) }}</textarea>
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Giới thiệu</label>
                    <textarea id="bio" name="bio" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="bg-primary text-white py-2 px-6 rounded-lg font-medium hover:bg-primary/90 transition-colors duration-200">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

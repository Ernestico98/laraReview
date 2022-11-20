<x-site-layout text="Edit user information">
    <div class="mx-[25%] my-8">
        <x-form method="post" route="{{route('users.update', $user->id)}}" submit="Save">
            @method('put')

            <div class="mb-8 rounded-lg w-48 h-48">
                <img src="{{asset('img/profile.jpeg')}}" class="rounded-lg">
                TODO: Change photo
            </div>

            <x-form-text-input label="Name" name="name" placeholder="user's name" value="{{$user->name}}" />

            <x-form-text-input label="Email" name="email" placeholder="user's email" value="{{$user->email}}"/>

            <x-form-text-input label="Password" name="password" placeholder="password" value=""/>

            <x-form-text-input label="Password Confirmation" name="password_confirmation" placeholder="password" value=""/>

            @if (auth()->user()->isAdmin)
                <div class="mt-4">
                    <input type="checkbox" name="isAdmin" @if($user->isAdmin) checked @endif/>
                    <label for="isAdmin"> Admin Privileges </label>
                </div>
            @endif

        </x-form>
    </div>

</x-site-layout>

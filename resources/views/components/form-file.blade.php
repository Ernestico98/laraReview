<div class="mt-2 mb-4">
    <div class="flex place-items-center">
        <label class="w-24 text-gray-500 text-sm" for="{{$name}}">{{$label}}</label>
        <input type="file" name="{{$name}}" value="{{ old($name, $value)  }}" class="w-64 p-1">
    </div>
    <x-form-error name="{{$name}}"/>
</div>

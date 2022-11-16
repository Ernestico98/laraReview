<div class="flex place-items-center mt-6">
    <label for="{{$name}}" class="w-24 text-sm text-gray-500 ">{{$label}}</label>
    <input type="text" name="{{$name}}" placeholder="{{$placeholder}}" value="{{old($name, $value)}}" class="w-64 border border-gray-400 rounded-sm p-1">
</div>
<x-form-error name="{{$name}}"/>

<div class="flex place-items-center mt-6">
    <label for="{{$name}}" class="w-24 text-sm text-gray-500">{{$label}}</label>
    <textarea name="{{$name}}" placeholder="{{$placeholder}}" class="w-[{{$width}}px] h-{{$height}} border border-gray-400 rounded-sm p-1">{{old($name, "")}}</textarea>
</div>
<x-form-error name="{{$name}}"/>

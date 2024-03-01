@php $editing = isset($wpComment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_post_ID"
            label="Comment Post Id"
            :value="old('comment_post_ID', ($editing ? $wpComment->comment_post_ID : '0'))"
            maxlength="255"
            placeholder="Comment Post Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="comment_author"
            label="Comment Author"
            maxlength="255"
            required
            >{{ old('comment_author', ($editing ? $wpComment->comment_author :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_author_email"
            label="Comment Author Email"
            :value="old('comment_author_email', ($editing ? $wpComment->comment_author_email : ''))"
            maxlength="255"
            placeholder="Comment Author Email"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_author_url"
            label="Comment Author Url"
            :value="old('comment_author_url', ($editing ? $wpComment->comment_author_url : ''))"
            maxlength="255"
            placeholder="Comment Author Url"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_author_IP"
            label="Comment Author Ip"
            :value="old('comment_author_IP', ($editing ? $wpComment->comment_author_IP : ''))"
            maxlength="255"
            placeholder="Comment Author Ip"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="comment_date"
            label="Comment Date"
            value="{{ old('comment_date', ($editing ? optional($wpComment->comment_date)->format('Y-m-d\TH:i:s') : '0000-00-00 00:00:00')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="comment_date_gmt"
            label="Comment Date Gmt"
            value="{{ old('comment_date_gmt', ($editing ? optional($wpComment->comment_date_gmt)->format('Y-m-d\TH:i:s') : '0000-00-00 00:00:00')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="comment_content"
            label="Comment Content"
            maxlength="255"
            required
            >{{ old('comment_content', ($editing ? $wpComment->comment_content :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="comment_karma"
            label="Comment Karma"
            :value="old('comment_karma', ($editing ? $wpComment->comment_karma : '0'))"
            max="255"
            placeholder="Comment Karma"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_approved"
            label="Comment Approved"
            :value="old('comment_approved', ($editing ? $wpComment->comment_approved : '1'))"
            maxlength="255"
            placeholder="Comment Approved"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_agent"
            label="Comment Agent"
            :value="old('comment_agent', ($editing ? $wpComment->comment_agent : ''))"
            maxlength="255"
            placeholder="Comment Agent"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_type"
            label="Comment Type"
            :value="old('comment_type', ($editing ? $wpComment->comment_type : 'comment'))"
            maxlength="255"
            placeholder="Comment Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_parent"
            label="Comment Parent"
            :value="old('comment_parent', ($editing ? $wpComment->comment_parent : '0'))"
            maxlength="255"
            placeholder="Comment Parent"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_id"
            label="User Id"
            :value="old('user_id', ($editing ? $wpComment->user_id : '0'))"
            maxlength="255"
            placeholder="User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>

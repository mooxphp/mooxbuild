@php $editing = isset($wpPost) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_author"
            label="Post Author"
            :value="old('post_author', ($editing ? $wpPost->post_author : '0'))"
            maxlength="255"
            placeholder="Post Author"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="post_date"
            label="Post Date"
            value="{{ old('post_date', ($editing ? optional($wpPost->post_date)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="post_date_gmt"
            label="Post Date Gmt"
            value="{{ old('post_date_gmt', ($editing ? optional($wpPost->post_date_gmt)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="post_content"
            label="Post Content"
            maxlength="255"
            required
            >{{ old('post_content', ($editing ? $wpPost->post_content : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="post_title"
            label="Post Title"
            maxlength="255"
            required
            >{{ old('post_title', ($editing ? $wpPost->post_title : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="post_excerpt"
            label="Post Excerpt"
            maxlength="255"
            required
            >{{ old('post_excerpt', ($editing ? $wpPost->post_excerpt : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_status"
            label="Post Status"
            :value="old('post_status', ($editing ? $wpPost->post_status : 'publish'))"
            maxlength="20"
            placeholder="Post Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_status"
            label="Comment Status"
            :value="old('comment_status', ($editing ? $wpPost->comment_status : 'open'))"
            maxlength="20"
            placeholder="Comment Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ping_status"
            label="Ping Status"
            :value="old('ping_status', ($editing ? $wpPost->ping_status : 'open'))"
            maxlength="20"
            placeholder="Ping Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_password"
            label="Post Password"
            :value="old('post_password', ($editing ? $wpPost->post_password : ''))"
            maxlength="255"
            placeholder="Post Password"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_name"
            label="Post Name"
            :value="old('post_name', ($editing ? $wpPost->post_name : ''))"
            maxlength="200"
            placeholder="Post Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="to_ping"
            label="To Ping"
            maxlength="255"
            required
            >{{ old('to_ping', ($editing ? $wpPost->to_ping : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="pinged" label="Pinged" maxlength="255" required
            >{{ old('pinged', ($editing ? $wpPost->pinged : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="post_modified"
            label="Post Modified"
            value="{{ old('post_modified', ($editing ? optional($wpPost->post_modified)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="post_modified_gmt"
            label="Post Modified Gmt"
            value="{{ old('post_modified_gmt', ($editing ? optional($wpPost->post_modified_gmt)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="post_content_filtered"
            label="Post Content Filtered"
            maxlength="255"
            required
            >{{ old('post_content_filtered', ($editing ?
            $wpPost->post_content_filtered : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_parent"
            label="Post Parent"
            :value="old('post_parent', ($editing ? $wpPost->post_parent : '0'))"
            maxlength="255"
            placeholder="Post Parent"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="guid"
            label="Guid"
            :value="old('guid', ($editing ? $wpPost->guid : ''))"
            maxlength="255"
            placeholder="Guid"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="menu_order"
            label="Menu Order"
            :value="old('menu_order', ($editing ? $wpPost->menu_order : '0'))"
            max="255"
            placeholder="Menu Order"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_type"
            label="Post Type"
            :value="old('post_type', ($editing ? $wpPost->post_type : 'post'))"
            maxlength="20"
            placeholder="Post Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_mime_type"
            label="Post Mime Type"
            :value="old('post_mime_type', ($editing ? $wpPost->post_mime_type : ''))"
            maxlength="100"
            placeholder="Post Mime Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_count"
            label="Comment Count"
            :value="old('comment_count', ($editing ? $wpPost->comment_count : '0'))"
            maxlength="255"
            placeholder="Comment Count"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>

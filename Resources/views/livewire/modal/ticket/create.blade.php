<x-modal.skin on-submit="save()" :content-padding="false">
	<x-slot name="title">Add Ticket</x-slot>
	@if(session('status'))
	<div class="alert alert-success" role="alert">
		{!! session('status') !!}
	</div>
	@endif
    {{--
	<form method="POST" action="route('tickets.store')" enctype="multipart/form-data">
		@csrf
    --}}
    <form class="" wire:submit.prevent="save()" enctype="multipart/form-data">
        @guest
        <x-input.group type="text" name="author_name" tpl="v2" />
        <x-input.group type="email" name="author_email" tpl="v2" />
        @endguest
        <x-input.group type="select" name="categories" :options="$category_opts" tpl="v2" />
		<x-input.group type="text" name="title" tpl="v2" />
		<x-input.group type="textarea" name="content" tpl="v2" />


		<div class="form-group row mb-0">
			<div class="col-md-8 offset-md-4">
				<button type="submit" class="btn btn-primary">
				@lang('ticket::global.submit')
				</button>
			</div>
		</div>
	</form>
	{{--
	<x-slot name="buttons">
		<button type="submit">
		Save Changes
		</button>
		<button type="button" wire:click="$emit('modal.close')">
		Cancel
		</button>
	</x-slot>
	--}}
</x-modal.skin>



<div class="container-fluid">
    <div class="row align-items-center justify-content-center min-vh-100">
        <div class="col-md-8">
            <div class="card text-center">
                <h2 class="card-header">{{ __('Contact me') }}</h2>
                <div class="card-body">
                    <form action="{{ url('contact') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                   id="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">@error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control  @error('first_name') is-invalid @enderror"
                                   name="first_name" id="first_name" placeholder="{{__('First_name')}}"
                                   value="{{ old('first_name') }}">
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                   name="email"
                                   id="email" placeholder="{{__('E-Mail Address')}}" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control  @error('message') is-invalid @enderror" rows="6"
                                      name="message" id="message"
                                      placeholder="{{__('Message')}}">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

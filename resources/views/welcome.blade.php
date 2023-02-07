{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!------ Include the above in your HEAD tag ---------->
<style>
    #custom-search-input{
        padding: 3px;
        border: solid 1px #E4E4E4;
        border-radius: 6px;
        background-color: #fff;
    }

    #custom-search-input input{
        border: 0;
        box-shadow: none;
    }

    #custom-search-input button{
        margin: 2px 0 0 0;
        background: none;
        box-shadow: none;
        border: 0;
        color: #666666;
        padding: 0 8px 0 10px;
        border-left: solid 1px #ccc;
    }

    #custom-search-input button:hover{
        border: 0;
        box-shadow: none;
        border-left: solid 1px #ccc;
    }

    #custom-search-input .glyphicon-search{
        font-size: 23px;
    }
</style>

<div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h2>Create Image</h2>
            <form id="img_form" method="POST" action="{{ url('/') }}">
                @csrf
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" value="{{ !empty($image->filename) ? asset('storage') . '/' . $image->filename : '' }}" class="form-control input-lg" placeholder="Enter text" name="img_name" id="img_name" {{ !empty($image->filename) ? 'disabled' : '' }}/>
                        @if(empty($image->filename))
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg create-img" type="button">
                                    Create
                                </button>
                            </span>
                        @else
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg copy-img-url" type="button">
                                    Copy
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <a class="btn btn-info btn-lg" href="{{ url('/') }}">
                                    Reset
                                </a>
                            </span>
                        @endif
                    </div>
                    @if(! empty($image->filename))
                        <div class="col-md-12">
                            <img src="{{ asset('storage') . '/' . $image->filename }}" width="50%" height="auto">
                        </div>
                    @endif
                </div>
            </form>
        </div>
	</div>
</div>

<script>
    $(".copy-img-url").click(function(){
        copyToClipboard($('#img_name').val());
    });
    function copyToClipboard(text) {
        var textArea = document.createElement( "textarea" );
        textArea.value = text;
        document.body.appendChild( textArea );
        textArea.select();
        try {
            var successful = document.execCommand( 'copy' );
            var msg = successful ? 'successful' : 'unsuccessful';
            alert('Image URL copied to clipboard');
        } catch (err) {
            console.log('Oops, unable to copy',err);
        }    
        document.body.removeChild( textArea );
    }

    $(".create-img").click(function() {
        $(this).html('<i class="fa-solid fa-spinner fa-spin"></i> Processing...');
        $(this).prop('disabled', true);
        $( "#img_form" ).submit();
    });

    $("#img_form").submit(function() {
        $('.create-img').html('<i class="fa-solid fa-spinner fa-spin"></i> Processing...');
        $('.create-img').prop('disabled', true);
    });
</script>
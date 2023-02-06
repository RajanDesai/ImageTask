<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .gallery-title
    {
        font-size: 36px;
        color: #42B32F;
        text-align: center;
        font-weight: 500;
        margin-bottom: 70px;
    }
    .gallery-title:after {
        content: "";
        position: absolute;
        width: 7.5%;
        left: 46.5%;
        height: 45px;
        border-bottom: 1px solid #5e5e5e;
    }
    .filter-button
    {
        font-size: 18px;
        border: 1px solid #42B32F;
        border-radius: 5px;
        text-align: center;
        color: #42B32F;
        margin-bottom: 30px;

    }
    .filter-button:hover
    {
        font-size: 18px;
        border: 1px solid #42B32F;
        border-radius: 5px;
        text-align: center;
        color: #ffffff;
        background-color: #42B32F;

    }
    .btn-default:active .filter-button:active
    {
        background-color: #42B32F;
        color: white;
    }

    .port-image
    {
        width: 100%;
    }

    .gallery_product
    {
        margin-bottom: 30px;
    }
</style>

 <div class="container">
        <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">Images</h1>
        </div>
        <br/>
            @foreach($images as $image)
                <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                    <a href="{{ url('images') . '/' .$image->id . '/edit' }}">
                        <img src="{{ asset('storage') . '/' . $image->filename }}" class="img-responsive">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

const seacrhMovie = function(){
    $('#movie').html('');
    $.ajax({
        url: 'https://www.omdbapi.com',
        type: 'GET',
        dataType: 'json',
        data: {
            'apikey': '2d7b5208',
            's': $('#inputSearch').val()
        },
        success: function(result) {
            let movies = result.Search;
            if (result.Response == "True") {
                $.each(movies, function(i, data){
                    $('#movie').append('<div class="col-md-4"><div class="card"><img src="'+ data.Poster +'" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title">'+ data.Title +'</h5><p class="card-text">'+ data.Year +'</p> <a href="#" class="detail btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="'+ data.imdbID +'">Detail</a></div></div></div>');
                });
                $('#inputSearch').val('');
            } else {
                $('#movie').html('<div class="col"><h1 class="text-center">'+ result.Error +'</h1></div>');
            }    
        },
        error: function(error) {
            console.error('Error connecting to the OMDB API:', error);
        }
    });
};
$('#btnSearch').on('click', function() {
    seacrhMovie();
});
$('#inputSearch').on('keyup', function(e){
    if(e.keyCode == 13){
        seacrhMovie();
    }
});
$('#movie').on('click', '.detail', function(){
    $.ajax({
        url: 'https://www.omdbapi.com',
        type: 'GET',
        dataType: 'json',
        data: {
            'apikey': '2d7b5208',
            'i': $(this).data('id')
        },
        success: function(movie) {
            if (movie.Response == "True") {
                    $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="`+ movie.Poster +`">
                            </div>
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item">`+ movie.Title +`</li>
                                    <li class="list-group-item">`+ movie.Genre +`</li>
                                    <li class="list-group-item">`+ movie.Actors +`</li>
                                    <li class="list-group-item">`+ movie.Plot +`</li>
                                    <li class="list-group-item">`+ movie.Language +`</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    `);
            } else {
                alert('Gagal')
            }    
        },
        error: function(error) {
            console.error('Error connecting to the OMDB API:', error);
        }
    });
});

$.ajax({
    url: 'https://www.omdbapi.com',
    type: 'GET',
    dataType: 'json',
    data: {
        apikey: '2d7b5208', 
    },
    success: function(hasil) {
        $.each(hasil.Menu, function(i, data) {
            $('#film').append('<div class="col-md-4"><div class="card"><img src="' + data.Poster + '" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title">' + data.Title + '</h5><p class="card-text">' + data.Year + '</p> <a href="#" class="detail btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' + data.imdbID + '">Detail</a></div></div></div>');
        });
    },
    error: function(error) {
        console.error('Error connecting to the OMDB API:', error);
    }
});
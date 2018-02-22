
$(document).ready(function () {
    load_movie_data(1);
    function getSearchData() {
        searchData = [];
        searchData [0] = $('#search').val();
        searchData [1] = $('#genre').val();
        return searchData;
    }

    function load_movie_data(page, search, genre)
    {
        $.ajax({
            url: base_url + "app/pagination/" + page,
            method: "POST",
            data: {genre: genre, searchText: search},
            dataType: "json",
            success: function (data)
            {
                console.log(data);
                $('#movieList').html(data.movieList);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }

    $(document).on("click", ".pagination li a", function (event) {
        event.preventDefault();
        var page = $(this).data("ci-pagination-page");
        searchData = getSearchData();
        load_movie_data(page, searchData[0], searchData[1]);
    });

    $(document).on('keyup', '#search', function () {

        searchData = getSearchData();
        load_movie_data(1, searchData[0], searchData[1]);

    });
    $(document).on('change', '#genre', function () {
        searchData = getSearchData();
        load_movie_data(1, searchData[0], searchData[1]);

    });

});

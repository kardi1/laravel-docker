@extends('base')

@section('main')
    <div class="col-sm-12">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <h1 class="display-3">Users</h1>
    <div>
        <a style="margin: 19px;" href="{{ route('users.create')}}" class="btn btn-primary">New user</a>
    </div>
    <div class="mb-5 d-flex">
        <div class="col-3 mt-3">
            <label>Pagination</label>
            <select id="pagination" class="form-control">
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="mb-3 mt-3 col-3">
            <div>
                <label for="search-name">Search name:</label>
                <input id="search-name" placeholder="search" type="text" value="" class="form-control" />
            </div>
            <button id="search-name-button" class="btn btn-default mt-3 float-right" type="button">Search</button>
        </div>
        <div class="mb-3 mt-3 col-3">
            <label>Show Accesses:</label>
            <button id="more-access-button" class="btn btn-default mt-3 float-right" type="button">More</button>
            <button id="less-access-button" class="btn btn-default mt-3 float-right" type="button">Less</button>
        </div>
    </div>
    <div class="row" id="table_data">
        @include('users.pagination_data')
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var dir = "";
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var pagination = $("select#pagination").children("option:selected").val();
                fetch_data(page, pagination, dir);
            });
            $("select#pagination").change(function(){
                var page = $(".pagination .active span").text();
                var pagination = $(this).children("option:selected").val();
                fetch_data(page, pagination, dir);
            });
            $(document).on('click', '#name-ordenation', function(event){
                var page = $(".pagination .active span").text();
                var selectedPagination = $("select#pagination").children("option:selected").val();
                if(dir === "asc") {
                    dir = "desc";
                } else if (dir === "desc") {
                    dir = "asc";
                } else {
                    dir = "asc";
                }
                fetch_data(page, selectedPagination, dir);
            });

            function fetch_data(page, pagination, ordenation)
            {
                $.ajax({
                    type:"GET",
                    url:"/users/fetchData?page="+page+"&pagination="+pagination+"&ordenation="+ordenation,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        if(dir === "asc") {
                            $("#name-order-icon").css('transform', 'rotateX(180deg)');
                        } else if (dir === "desc") {
                            $("#name-order-icon").css('transform', 'rotateX(0)');
                        }
                    }
                });
            }

            $(document).on('click', 'button#search-name-button', function(event){
                var searchName = $("input#search-name").val();
                search_name(searchName);
            });

            function search_name(searchName)
            {
                $.ajax({
                    type:"GET",
                    url:"/users/searchName?name="+searchName,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                    }
                });
            }

            $(document).on('click', 'button#more-access-button', function(event){
                more_or_less_search('desc');
            });

            $(document).on('click', 'button#less-access-button', function(event){
                more_or_less_search('asc');
            });

            function more_or_less_search(search)
            {
                $.ajax({
                    type:"GET",
                    url:"/users/moreOrLessAccess?search="+search,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection

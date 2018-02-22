<div class="row marginBottom-10">
    <div class="col-md-4 pull-left">
        <div class="input-group">
            <select class="form-control" id="genre">
                <option value="">Genres</option>
                <?php
                foreach ($genres as $genre) {
                    echo "<option value='" . $genre . "'>" . $genre . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-6 pull-right">
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                <input type="text" id="search" class="form-control" placeholder="Search by title" />
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>

</div>
<div id="movieList"></div>
<div align="right" id="pagination_link"></div>
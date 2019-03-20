<?php include "../include/_layout/header.html";?>
<script src="../include/_js/queries.js"></script>
<div class="container-fluid">
    <div class="row content justify-content-center full-height">
        <div class="col-md-12 p-0">
            <h3 class="text-center mt-4 mb-4">Query Builder</h3>
            <form>
                <div class="row content justify-content-center" style="overflow:auto;">
                    <div class="col-md-12 p-0">
                        <table id="query-builder" class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                    <th style="width: 38px;">
                                        <input class="form-control btn btn-outline-dark" id="add-row-btn" type="button"
                                            value="&#10011;">
                                    </th>
                                    <th>Field</th>
                                    <th>Operator</th>
                                    <th>Value</th>
                                    <th>Next</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row content justify-content-center">
                    <input id="btn-submit" type="button" class="btn btn-primary" value="Submit">
                    &nbsp;&nbsp;&nbsp;
                    <input id="btn-reset" type="reset" class="btn btn-danger" value="Reset">
                    <div class="col-md-12 p-0">
                        <br />
                        <table id="result-table" style="display:none;">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="title">Title</th>
                                    <th data-field="released_date">Released Date</th>
                                    <th data-field="genre">Genre(s)</th>
                                    <th data-field="platform">Platform(s)</th>
                                    <th data-field="publishers">Publishers(s)</th>
                                    <th data-field="rate">Rate/5</th>
                                    <!-- <th data-field="completed">Completed</th> -->
                                    <!-- <th data-field="description">Description</th> -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
            <br />
        </div>
    </div>
</div>
<?php include "../include/_layout/footer.html";?>
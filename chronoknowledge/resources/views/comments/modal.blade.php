<!-- Modal for comments-->
<div class="modal" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="editComment" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:35rem; background-color:rgba(192,192,192)">
            <div class="modal-header">
                <div class="ml-1" style="width: fit-content;">
                    <button type="button" class="close text-danger" aria-label="Close" data-toggle="modal">
                        <i class="fa-solid fa-circle-arrow-left"></i>
                    </button>
                </div>
                <h5 class="modal-title modalHeader" id="exampleModalLongTitle" style="width:fit-content;margin-right:40%;">Edit Comment</h5>
            </div>

            <div class="modal-body">

                <form class="form" action="post/comment/edit" method="POST" id="commentForm" style="width: 35rem;text-align:left">
                    @csrf
                    <div class="container-fluid mb-2 row col-12">
                        <div class="col-sm-9">
                            <textarea type="text" class="textarea form-control ml-1 text-align-justify commentForEdit" name="comment" id="commentForPost" placeholder="" rows="4" cols="100"></textarea>
                            <span class="ml-12 characterCountCommentEdit" style="margin-left:59%">0 character</span>
                        </div>
                        <div class="col-sm-2 mt-4 ml-2">
                            <span class="span" style="color:red">*</span>
                            <button class="btn ml-3 editCommentBtn" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                        <div class="text-danger errMessageComment" style="display:none">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

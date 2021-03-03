 <!-- Delete Model -->
 <form action="" method="POST" class="remove-record-model modal_delete">
        {{method_field('DELETE')}}
        @csrf

       <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
           <div class="modal-dialog modal-dialog-centered" style="width:55%;">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title" id="custom-width-modalLabel"> تاكيد الحذف</h4>
                   </div>
                   <div class="modal-body">
                       <h4>هل انت متاكد من الحذف</h4>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">الغاء</button>
                       <button type="submit" class="btn btn-danger waves-effect waves-light">حذف</button>
                   </div>
               </div>
           </div>
       </div>
   </form>

      <!-- /.modal -->

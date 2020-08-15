<div class="wrap">
<div id="simpleredirect-modaledit" class="modal">
  <div class="col-wrap">
      <div class="form-wrap">
         <h2>Edit Redirect</h2>
         <div class="form-field">
            <label for="old_url">Old URL</label>
            <input name="old_url" id="editold_url" type="text" value="">
            <p>The current URL that you want to be redirected.</p>
         </div>
         <div class="form-field">
            <label for="new_url">New URL</label>
            <input name="new_url" id="editnew_url" type="text" value="">
            <p>A URL that you want to redirect to.</p>
         </div>
         <div class="form-field">
            <label for="http_status">HTTP Status</label>
            <input name="http_status" id="edithttp_status" type="text" value="">
         </div>
         
         <input type="submit" class="button button-primary" onclick="savemodal(this)" value="Save"><span class="spinner"></span>
         <input type="submit" class="button button-primary" onclick="closemodal(this)" value="Close"><span class="spinner"></span>
         
      </div>
   </div>
</div>
<h2>Simple Redirect Settings</h2>
<p>This is a description</p>
<?php settings_errors(); ?>


<div id="col-container" class="wp-clearfix">

<div id="col-left">
   <div class="col-wrap">
      <div class="form-wrap">
         <h2>Add New Redirect</h2>
         <div class="form-field">
            <label for="old_url">Old URL</label>
            <input name="old_url" id="old_url" type="text" value="">
            <p>The current URL that you want to be redirected.</p>
         </div>
         <div class="form-field">
            <label for="new_url">New URL</label>
            <input name="new_url" id="new_url" type="text" value="">
            <p>A URL that you want to redirect to.</p>
         </div>
         <div class="form-field">
            <label for="http_status">HTTP Status</label>
            <input name="http_status" id="http_status" type="text" value="">
         </div>
         
            <input type="submit" name="simpleredirect-btnsave" id="simpleredirect-btnsave" class="button button-primary" value="Save"><span class="spinner"></span>
         
      </div>
   </div>
</div>
<div id="col-right">
   <div class="col-wrap">
      <table id="simpleredirect-list" class="wp-list-table widefat fixed striped table-view-list tags">
         <thead>
            <tr>
               <th scope="col" class="manage-column column-name column-primary">Old URL</th>
               <th scope="col" class="manage-column column-name">New URL</span></th>
               <th scope="col" class="manage-column column-name">HTTP Status</span></th>
            </tr>
         </thead>
         <tbody data-wp-lists="list:tag">
            <tr class="level-0">
               <td class="has-row-actions column-primary">Old URL<div class="row-actions"><button type="button" class="button-link">Edit Redirect</button> | <button type="button" class="button-link">Delete Redirect</button></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button></td>
               <td data-colname="New URL">New URL</td>
               <td data-colname="HTTP Status">HTTP Status</td>
            </tr>
         </tbody>
      </table>
      <div class="tablenav bottom">
         <input type="submit" name="simpleredirect-btnapply" id="simpleredirect-btnapply" class="button action" value="Apply">                     
      </div>
   </div>
</div>


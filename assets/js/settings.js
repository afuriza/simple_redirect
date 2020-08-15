var currentitem; 
$(document).ready(function() {


	window.closemodal = function(owner) {
    	$(owner).closest("div.modal").hide();
    }

    window.savemodal = function(owner) {
    	if ($('#editold_url').val() != "") {


	    	var httpstatus;
	    	var newurl;
	    	applyitem = currentitem.closest('tr');
	    	// alert(currentitem.html());
	    	if ($('#edithttp_status').val() == "") {
	    		httpstatus = "undefined";
	    	} else {
	    		httpstatus = $('#edithttp_status').val();
	    	}
	    	if ($('#editnew_url').val() == "") {
	    		newurl = "undefined";
	    	} else {
	    		newurl = $('#editnew_url').val();
	    	}
	    	applyitem.closest('tr').html(
				'<td class="has-row-actions column-primary" oldurl="'+$('#editold_url').val()+'" newurl="'+$('#editnew_url').val()+
				'" httpstatus="'+$('#edithttp_status').val()+'">'+$('#editold_url').val()+
	        	'<div class="row-actions"><button type="button" name="simpleredirect-btnedit" class="button-link">'+
	        	'Edit Redirect</button> | <button type="button" name="simpleredirect-btndel" class="button-link">Delete Redirect'+
	        	'</button></div><button type="button" class="toggle-row"><span class="screen-reader-text">'+
	        	'Show more details</span></button></td>'+
	        	'<td data-colname="New URL">'+newurl+'</td>'+
	        	'<td data-colname="HTTP Status">'+httpstatus+'</td>'
	    	);
	    	$(owner).closest("div.modal").hide();
	    	$(owner).closest("div.modal").scrollTop();
	    } else {
	    	alert("Old URL must not empty!");
	    }
    }

	$("#simpleredirect-list tbody").empty();

	$.getJSON( "/wp-json/simpleredirect/config/read/", function( data ) {
		// items = data.redirects;
		// alert(JSON.stringify(data.redirects));
		try {
	  		$.each(data.redirects, function(key, val){
	  			var httpstatus;
	  			if (val.httpstatus == ""){
	  				httpstatus = "undefined";
	  			} else {
	  				httpstatus = val.httpstatus;
	  			}
	    		$("#simpleredirect-list tbody").append(
				  	'<tr class="level-0">'+
			               '<td class="has-row-actions column-primary" oldurl="'+val.oldurl+'" newurl="'+val.newurl+'" httpstatus="'+
			               val.httpstatus+'">'+val.oldurl+
			               '<div class="row-actions"><button type="button" name="simpleredirect-btnedit" class="button-link">'+
			               'Edit Redirect</button> | <button type="button" name="simpleredirect-btndel" class="button-link">Delete Redirect'+
			               '</button></div><button type="button" class="toggle-row"><span class="screen-reader-text">'+
			               'Show more details</span></button></td>'+
			               '<td data-colname="New URL">'+val.newurl+'</td>'+
			               '<td data-colname="HTTP Status">'+httpstatus+'</td>'+
			        '</tr>');
	  		});
	  	} catch (err) {

	  	}
	});
	

    $("#simpleredirect-btnsave").click(function() {
    	var httpstatus;
		var newurl;
    	if ($('#old_url').val() != "") {
    		
    		if ($('#http_status').val() == "") {
	    		httpstatus = "undefined";
	    	} else {
	    		httpstatus = $('#http_status').val();
	    	}
	    	if ($('#new_url').val() == "") {
	    		newurl = "undefined";
	    	} else {
	    		newurl = $('#new_url').val();
	    	}
			$("#simpleredirect-list tbody").append(
			  	'<tr class="level-0">'+
		               '<td class="has-row-actions column-primary" oldurl="'+$('#old_url').val()+'" newurl="'+$('#new_url').val()+'" httpstatus="'+
		               $('#http_status').val()+'">'+$('#old_url').val()+
		               '<div class="row-actions"><button type="button" name="simpleredirect-btnedit" class="button-link">'+
		               'Edit Redirect</button> | <button type="button" name="simpleredirect-btndel" class="button-link">Delete Redirect'+
		               '</button></div><button type="button" class="toggle-row"><span class="screen-reader-text">'+
		               'Show more details</span></button></td>'+
		               '<td data-colname="New URL">'+newurl+'</td>'+
		               '<td data-colname="HTTP Status">'+httpstatus+'</td>'+
		        '</tr>');
		} else {
	    	alert("Old URL must not empty!");
	    }
	});

	$("#simpleredirect-btnapply").click(function() {
		try {
			var redirects = {
					redirects: []
				};
			$('#simpleredirect-list tbody').each(function() {
			    redirects.redirects.push(
				    {
						oldurl: $(this).find("tr").find("td.column-primary").attr("oldurl"),
						newurl: $(this).find("tr").find("td.column-primary").attr("newurl"),
						httpstatus: $(this).find("tr").find("td.column-primary").attr("httpstatus").replace('undefined','')
					}
				);    
			});
			$.ajax({
		        type: "POST",
		        url: "/wp-json/simpleredirect/config/write/",
		        data: JSON.stringify(redirects),
		        success: function(data) {
		        	alert(data);
		        },
		        dataType: "text",
		        contentType : "text/plain"
		    });
		} catch (err) {
			alert("Data can't be submitted")
		}
		
	});
});

$(document).on("click",'#simpleredirect-list tbody tr td button[name=simpleredirect-btndel]', function() { // any button
	$(this).closest('tr').remove();
});

$(document).on("click",'#simpleredirect-list tbody tr td button[name=simpleredirect-btnedit]', function() { // any button
	// alert($(this).closest('td').attr("newurl"));
	currentitem = $(this).closest('td');
	$('#editold_url').val(currentitem.attr("oldurl"));
	$('#editnew_url').val(currentitem.attr("newurl"));
	if (currentitem.attr("httpstatus") == "undefined"){
		$('#edithttp_status').val("");
	} else {
		$('#edithttp_status').val(currentitem.attr("httpstatus"));
	}
	
	$("#simpleredirect-modaledit").show();
});

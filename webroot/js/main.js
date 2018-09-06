function filterCustomers(str) {


	var eGroups = document.getElementById("customer_select").childNodes;
	var eElements;
	var group;
	var element;
	var groupVisible;
	if (str.length == 0) {
		// make everything visible again
		for (group = 0; group < eGroups.length; group++) {
			eElements = eGroups[group].childNodes;
			for (element = 0; element < eElements.length; element++) {
				eElements[element].style.visibility = 'visible';
			}
			eGroups[group].style.visibility = 'visible';

		}
		return;
	}

	for (group = 0; group < eGroups.length; group++) {
		groupVisible = false;
		eElements = eGroups[group].childNodes;
		for (element = 0; element < eElements.length; element++) {
			if (eElements[element].innerHTML.indexOf(str) > -1) {
				eElements[element].style.visibility = 'visible';
				groupVisible = true;
			} else {
				eElements[element].style.visibility = 'hidden';
			}
		}
		if (groupVisible) {
			eGroups[group].visibility = 'visible';
		} else {
			eGroups[group].visibility = 'hidden';
		}

	}
	return;


}

function confirmNavigate(msg, url) {
	$("<div class='dialog-confirm'>" + msg + "</div>").appendTo($("body"));

	$('.dialog-confirm').dialog({
		resizable: false,
		height: "auto",
		width: "auto",
		modal: true,
		buttons: {
			"Ja": function () {
				$('<form name="confirmed_deletion" style="display:none;" method="post" action="'+url+'"><input name="_method" value="POST" type="hidden"></form>').appendTo($("body"));

				document.confirmed_deletion.submit();
			},
			"Nein": function () {
				$(this).dialog("close");
			}
		}
	});
}

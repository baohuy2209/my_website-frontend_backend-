<script type="text/javascript">
	/* Validation form */
	function ValidationFormSelf(ele)
	{
	    window.addEventListener('load', function(){
	        var forms = document.getElementsByClassName(ele);
	        var validation = Array.prototype.filter.call(forms, function(form) {
	            form.addEventListener('submit', function(event) {
	                if (form.checkValidity() === false) {
	                    event.preventDefault();
	                    event.stopPropagation();
	                }
	                form.classList.add('was-validated');
	            }, false);
	        });
	        $("."+ele).find("input[type=submit],button[type=submit]").removeAttr("disabled");
	    }, false);
	}

	/* Validation form chung */
	ValidationFormSelf("validation-form");

	/* onChange Category */
	function filter_category(url)
	{
		if($(".filer-category").length > 0 && url != '')
		{
			var id = '';
			var value = 0;

			$(".filer-category").each(function(){
				id = $(this).attr("id");
				if(id)
				{
					value = parseInt($("#"+id).val());
					if(value)
					{
						url += "&"+id+"="+value;
					}
				}
			})
		}

		return url;
	}

	function onchange_category(obj)
	{
		var name = '';
		var keyword = $("#keyword").val();
		var url = "<?=(isset($linkFilter) && $linkFilter != '') ? $linkFilter : ''?>";
		
		obj.parents(".form-group").nextAll().each(function(){
			name = $(this).find(".filer-category").attr("name");
			if($(this) != obj)
			{
				$(this).find(".filer-category").val(0);
			}
		});

		url = filter_category(url);

		if(keyword)
		{
			url += "&keyword="+encodeURI(keyword);
		}

		return window.location = url;
	}

	/* Search */
	function doEnter(evt,obj,url)
	{
		if(url=='')
		{
			notifyDialog("Đường dẫn không hợp lệ");
	        return false;
		}

	    if(evt.keyCode == 13 || evt.which == 13) onSearch(obj,url);
	}
	function onSearch(obj,url)
	{
		if(url=='')
		{
			notifyDialog("Đường dẫn không hợp lệ");
	        return false;
		}
		else
		{
			var keyword = $("#"+obj).val();
			url = filter_category(url);
			
			if(keyword)
			{
				url += "&keyword="+encodeURI(keyword);
			}

			window.location = filter_category(url);
		}
	}

	/* Action order (Search - Export excel - Export word) */
	function actionOrder(url)
    {
    	var listid = "";
        var tinhtrang = parseInt($("#tinhtrang").val());
        var httt = parseInt($("#httt").val());
        var ngaydat = $("#ngaydat").val();
        var khoanggia = $("#khoanggia").val();
        var city = parseInt($("#id_city").val());
        var district = parseInt($("#id_district").val());
        var wards = parseInt($("#id_wards").val());
        var keyword = $("#keyword").val();

        $("input.select-checkbox").each(function(){
	        if(this.checked) listid = listid+","+this.value;
	    });
	    listid = listid.substr(1);
	    if(listid) url += "&listid="+listid;
        if(tinhtrang) url += "&tinhtrang="+tinhtrang;
        if(httt) url += "&httt="+httt;
        if(ngaydat) url += "&ngaydat="+ngaydat;
        if(khoanggia) url += "&khoanggia="+khoanggia;
        if(city) url += "&id_city="+city;
        if(district) url += "&id_district="+district;
        if(wards) url += "&id_wards="+wards;
        if(keyword) url += "&keyword="+encodeURI(keyword);

        window.location = url;
    }

	/* Send email */
	function sendEmail()
	{
		var listemail="";

		$("input.select-checkbox").each(function(){
			if (this.checked) listemail = listemail+","+this.value;
		});
		listemail = listemail.substr(1);
		if(listemail == "")
	    {
	    	notifyDialog("Bạn hãy chọn ít nhất 1 mục để gửi");
	    	return false;
	    }
	    $("#listemail").val(listemail);
	    document.frmsendemail.submit();
	}

	/* Delete item */
	function deleteItem(url)
	{
	    document.location = url;
	}

	/* Delete all */
	function deleteAll(url)
	{
		var listid = "";

	    $("input.select-checkbox").each(function(){
	        if(this.checked) listid = listid+","+this.value;
	    });
	    listid = listid.substr(1);
	    if(listid == "")
	    {
	    	notifyDialog("Bạn hãy chọn ít nhất 1 mục để xóa");
	    	return false;
	    }
	    document.location = url+"&listid="+listid;
	}

	/* Create sort filer */
	var sortable;
	function createSortFiler()
	{
		if($("#jFilerSortable").length)
		{
			sortable = new Sortable.create(document.getElementById('jFilerSortable'),{
				animation: 600,
				swap: true,
				disabled: true,
				// swapThreshold: 0.25,
			    ghostClass: 'ghostclass',
			    multiDrag: true,
				selectedClass: 'selected',
				forceFallback: false,
				fallbackTolerance: 3,
				onEnd: function(){
					/* Get all filer sort */
					listid = new Array();
					jFilerItems = $("#jFilerSortable").find('.my-jFiler-item');
					jFilerItems.each(function(index){
						listid.push($(this).data("id"));
					})

					/* Update number */
					var idmuc = <?=(isset($id) && $id > 0) ? $id : 0?>;
					var com = '<?=(isset($com) && $com != '') ? $com : ''?>';
					var kind = '<?=(isset($act) && $act != '') ? $act : ''?>';
					var type = '<?=(isset($type) && $type != '') ? $type : ''?>';
					var colfiler = $(".col-filer").val();
					var actfiler = $(".act-filer").val();
					$.ajax({
						url: 'ajax/ajax_filer.php',
						type: 'POST',
						dataType: 'json',
						async: false,
						data: {idmuc:idmuc,listid:listid,com:com,kind:actfiler,type:type,colfiler:colfiler,cmd:'updateNumb',hash:'<?=$func->generateHash()?>'},
						success: function(result)
						{
							var arrid = result.id;
							var arrnumb = result.numb;
							for(var i=0;i<arrid.length;i++) $('.my-jFiler-item-'+arrid[i]).find("input[type=number]").val(arrnumb[i]);
						}
					})
				},
			});
		}
	}

	/* Destroy sort filer */
	function destroySortFiler()
	{
		try{var destroy = sortable.destroy();}
		catch(e){}
	}

	/* Refresh filer when complete action */
	function refreshFiler()
	{
		$(".sort-filer, .check-all-filer").removeClass("active");
		$(".sort-filer").attr('disabled',false);
		$(".alert-sort-filer").hide();
		if($(".check-all-filer").find("i").hasClass("fas fa-check-square"))
		{
			$(".check-all-filer").find("i").toggleClass("far fa-square fas fa-check-square");
		}
		$(".my-jFiler-items .jFiler-items-list").find('input.filer-checkbox').each(function(){
			$(this).prop('checked',false); 
		});
	}

	/* Refresh filer if empty */
	function refreshFilerIfEmpty()
    {
		var idmuc = <?=(isset($id) && $id > 0) ? $id : 0?>;
		var com = '<?=(isset($com) && $com != '') ? $com : ''?>';
		var type = '<?=(isset($type) && $type != '') ? $type : ''?>';
		var colfiler = $(".col-filer").val();
		var actfiler = $(".act-filer").val();
		var cmd = 'refresh';

		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: 'ajax/ajax_filer.php',
			async: false,
			data: {idmuc:idmuc,com:com,kind:actfiler,type:type,colfiler:colfiler,cmd:cmd,hash:'<?=$func->generateHash()?>'},
			success: function(result)
			{
				$(".jFiler-items-list").first().find(".jFiler-item").remove();
				destroySortFiler();
				$tmp = '<div class="form-group form-group-gallery">'
				+'<label class="label-filer">Album hiện tại:</label>'
				+'<div class="action-filer mb-3">'
				+'<a class="btn btn-sm bg-gradient-primary text-white check-all-filer mr-1"><i class="far fa-square mr-2"></i>Chọn tất cả</a>'
				+'<button type="button" class="btn btn-sm bg-gradient-success text-white sort-filer mr-1"><i class="fas fa-random mr-2"></i>Sắp xếp</button>'
				+'<a class="btn btn-sm bg-gradient-danger text-white delete-all-filer"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>'
				+'</div>'
				+'<div class="alert my-alert alert-sort-filer alert-info text-sm text-white bg-gradient-info"><i class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>'
				+'<div class="jFiler-items my-jFiler-items jFiler-row">'
				+'<ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">'
				+result
				+'</ul></div></div>';
				$("#filer-gallery").parents(".form-group").after($tmp);
				createSortFiler();
			}
		});
	}

	/* Delete filer */
	function deleteFiler(string)
	{
		var str = string.split(",");
		var id = str[0];
		var folder = str[1];
		var cmd = 'delete';

		$.ajax({
			type: 'POST',
			url: 'ajax/ajax_filer.php',
			data: {id:id,folder:folder,cmd:cmd}
		});

		$('.my-jFiler-item-'+id).remove();
		if($(".my-jFiler-items ul li").length==0) $(".form-group-gallery").remove();
	}

	/* Delete all filer */
	function deleteAllFiler(folder)
	{
		var listid = "";
		var cmd = 'delete-all';

	    $("input.filer-checkbox").each(function(){
	        if(this.checked) listid = listid+","+this.value;
	    });
	    listid = listid.substr(1);
	    if(listid == "")
	    {
	    	notifyDialog("Bạn hãy chọn ít nhất 1 mục để xóa");
	    	return false;
	    }

		$.ajax({
			type: 'POST',
			url: 'ajax/ajax_filer.php',
			data: {listid:listid,folder:folder,cmd:cmd}
		});

		listid = listid.split(",");
		for(var i=0;i<listid.length;i++)
		{
			$('.my-jFiler-item-'+listid[i]).remove();
		}

		if($(".my-jFiler-items ul li").length==0) $(".form-group-gallery").remove();

		refreshFiler();
	}

	/* Push OneSignal */
	function pushOneSignal(url)
	{
		document.location = url;
	}

	/* HoldOn */
	function holdonOpen(theme="sk-rect",text="Text here",backgroundColor="rgba(0,0,0,0.8)",textColor="white")
	{
		var options = {
			theme: theme,
			message: text,
			backgroundColor: backgroundColor,
			textColor: textColor
		};

		HoldOn.open(options);
	}
	function holdonClose()
	{
		HoldOn.close();
	}

	/* Sweet Alert - Notify */
	function notifyDialog(text)
	{
		const swalconst = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-sm bg-gradient-primary text-sm',
			},
			buttonsStyling: false
		})
		swalconst.fire({
			text: text,
			icon: "info",
			confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
			showClass: {
				popup: 'animated fadeIn faster'
			},
			hideClass: {
				popup: 'animated fadeOut faster'
			}
		})
	}

	/* Sweet Alert - Confirm */
	function confirmDialog(action,text,value)
	{
		const swalconst = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-sm bg-gradient-primary text-sm mr-2',
				cancelButton: 'btn btn-sm bg-gradient-danger text-sm'
			},
			buttonsStyling: false
		})
		swalconst.fire({
			text: text,
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
			cancelButtonText: '<i class="fas fa-times mr-2"></i>Hủy',
			showClass: {
				popup: 'animated zoomIn faster'
			},
			hideClass: {
				popup: 'animated fadeOut faster'
			}
		}).then((result) => {
			if(result.value)
			{
				if(action == "create-seo") seoCreate();
				if(action == "push-onesignal") pushOneSignal(value);
				if(action == "send-email") sendEmail();
				if(action == "delete-filer") deleteFiler(value);
				if(action == "delete-all-filer") deleteAllFiler(value);
				if(action == "delete-item") deleteItem(value);
				if(action == "delete-all") deleteAll(value);
			}
		})
	}

	/* Youtube preview */
	function youtubePreview(url,element)
	{
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    	var match = url.match(regExp);
    	url = (match&&match[7].length==11)? match[7] : false;
        $(element).attr("src","//www.youtube.com/embed/"+url).css({"width": "250","height": "150"});
	}

	/* SEO */
	function seoExist()
	{
		var inputs = $('.card-seo input.check-seo');
		var textareas = $('.card-seo textarea.check-seo');
		var flag = false;

		if(!flag)
		{
			inputs.each(function(index){
				var input = $(this).attr('id');
				value = $("#"+input).val();
				if(value)
				{
					flag = true;
					return false;
				}
			});
		}

		if(!flag)
		{
			textareas.each(function(index){
				var textarea = $(this).attr('id');
				value = $("#"+textarea).val();
				if(value)
				{
					flag = true;
					return false;
				}
			});
		}

		return flag;
	}
	function seoCreate()
	{
		var flag = true;
		var seolang = $("#seo-create").val();
		var seolangArray = seolang.split(",");
		var seolangCount = seolangArray.length;
		var inputArticle = $('.card-article input.for-seo');
		var textareaArticle = $('.card-article textarea.for-seo');
		var textareaArticleCount = textareaArticle.length;
		var count = 0;
		var inputSeo = $('.card-seo input.check-seo');
		var textareaSeo = $('.card-seo textarea.check-seo');

		/* SEO Create - Input */
		inputArticle.each(function(index){
			var input = $(this).attr('id');
			var lang = input.substr(input.length-2);
			if(seolang.indexOf(lang)>=0)
			{
				ten = $("#"+input).val();
				ten = ten.substr(0,70);
				ten = ten.trim();
				$("#title"+lang+", #keywords"+lang).val(ten);
				seoCount($("#title"+lang));
				seoCount($("#keywords"+lang));
			}
		});

		/* SEO Create - Textarea */
		textareaArticle.each(function(index){
			var textarea = $(this).attr('id');
			var lang = textarea.substr(textarea.length-2);
			if(seolang.indexOf(lang)>=0)
			{
				if(flag)
				{
					var content = $("#"+textarea).val();

					if(!content && CKEDITOR.instances[textarea])
					{
						content = CKEDITOR.instances[textarea].getData();
					}

					if(content)
					{
						content = content.replace(/(<([^>]+)>)/ig,"");
						content = content.substr(0,160);
						content = content.trim();
						content = content.replace(/[\r\n]+/gm," ");
						$("#description"+lang).val(content);
						seoCount($("#description"+lang));
						flag = false;
					}
					else
					{
						flag = true;
					}
				}
				count++;
				if(count == (textareaArticleCount/seolangCount))
				{
					flag = true;
					count = 0;
				}
			}
		});

		/* SEO Preview */
		for(var i=0;i<seolangArray.length;i++) if(seolangArray[i]) seoPreview(seolangArray[i]);
	}
	function seoPreview(lang)
	{
		var titlePreview = "#title-seo-preview"+lang;
		var descriptionPreview = "#description-seo-preview"+lang;
		var title = $("#title"+lang).val();
		var description = $("#description"+lang).val();

		if($(titlePreview).length)
		{
			if(title) $(titlePreview).html(title);
			else $(titlePreview).html("Title");
		}

		if($(descriptionPreview).length)
		{
			if(description) $(descriptionPreview).html(description);
			else $(descriptionPreview).html("Description");
		}
	}
	function seoCount(obj)
	{
		if(obj.length)
		{
			var countseo = parseInt(obj.val().toString().length);
			countseo = (countseo) ? countseo++ : 0;
			obj.parents("div.form-group").children("div.label-seo").find(".count-seo span").html(countseo);
		}
	}
	function seoChange()
	{
		var seolang = "vi,en";
		var elementSeo = $('.card-seo .check-seo');

		elementSeo.each(function(index){
			var element = $(this).attr('id');
			var lang = element.substr(element.length-2);
			if(seolang.indexOf(lang)>=0)
			{
				if($("#"+element).length)
				{
					$('body').on("keyup","#"+element,function(){
						seoPreview(lang);
					})
				}
			}
		});
	}

	/* Slug */
	function slugConvert(slug,focus=false)
	{
	    slug = slug.toLowerCase();
	    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
	    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
	    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
	    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
	    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
	    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	    slug = slug.replace(/đ/gi, 'd');
	    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
	    slug = slug.replace(/ /gi, "-");
	    slug = slug.replace(/\-\-\-\-\-/gi, '-');
	    slug = slug.replace(/\-\-\-\-/gi, '-');
	    slug = slug.replace(/\-\-\-/gi, '-');
	    slug = slug.replace(/\-\-/gi, '-');
	    
		if(!focus)
		{
			slug = '@' + slug + '@';
			slug = slug.replace(/\@\-|\-\@|\@/gi, '');
		}

	    return slug;
	}
	function slugPreview(title,lang,focus=false)
	{
		var slug = slugConvert(title,focus);

		$("#slug"+lang).val(slug);
		$("#slugurlpreview"+lang+" strong").html(slug);
		$("#seourlpreview"+lang+" strong").html(slug);
	}
	function slugPreviewTitleSeo(title,lang)
	{
		if($("#title"+lang).length)
		{
			var titleSeo = $("#title"+lang).val();
			if(!titleSeo)
			{
				if(title) $("#title-seo-preview"+lang).html(title);
				else $("#title-seo-preview"+lang).html("Title");	
			}
		}
	}
	function slugPress()
	{
		var sluglang = "vi,en";
		var inputArticle = $('.card-article input.for-seo');
		var id = $('.slug-id').val();
		var seourlstatic = true;
		// var seourlstatic = $(".slug-seo-preview").data("seourlstatic");

		inputArticle.each(function(index){
			var ten = $(this).attr('id');
			var lang = ten.substr(ten.length-2);
			if(sluglang.indexOf(lang)>=0)
			{
				if($("#"+ten).length)
				{
					$('body').on("keyup","#"+ten,function(){
						var title = $("#"+ten).val();

						if((!id || $("#slugchange").prop("checked")) && seourlstatic)
						{
							/* Slug preivew */
							slugPreview(title,lang);
						}

						/* Slug preivew title seo */
						slugPreviewTitleSeo(title,lang);

						/* slug Alert */
						slugAlert(2,lang);
					})
				}

				if($("#slug"+lang).length)
				{
					$('body').on("keyup","#slug"+lang,function(){
						var title = $("#slug"+lang).val();

						/* Slug preivew */
						slugPreview(title,lang,true);

						/* slug Alert */
						slugAlert(2,lang);
					})
				}
			}
		});
	}
	function slugChange(obj)
	{
		if(obj.is(':checked'))
		{
			/* Load slug theo tiêu đề mới */
			slugStatus(1);
			$(".slug-input").attr("readonly",true);
		}
		else
		{
			/* Load slug theo tiêu đề cũ */
			slugStatus(0);
			$(".slug-input").attr("readonly",false);
		}
	}
	function slugStatus(status)
	{
		var sluglang = "vi,en";
		var inputArticle = $('.card-article input.for-seo');

		inputArticle.each(function(index){
			var ten = $(this).attr('id');
			var lang = ten.substr(ten.length-2);
			if(sluglang.indexOf(lang)>=0)
			{
				var title = "";
				if(status == 1)
				{
					if($("#"+ten).length)
					{
						title = $("#"+ten).val();

						/* Slug preivew */
						slugPreview(title,lang);

						/* Slug preivew title seo */
						slugPreviewTitleSeo(title,lang);
					}
				}
				else if(status == 0)
				{
					if($("#slug-default"+lang).length)
					{
						title = $("#slug-default"+lang).val();

						/* Slug preivew */
						slugPreview(title,lang);

						/* Slug preivew title seo */
						slugPreviewTitleSeo(title,lang);
					}
				}
			}
		});
	}
	function slugAlert(result,lang)
	{
		if(result == 1)
		{
			$("#alert-slug-danger"+lang).addClass("d-none");
			$("#alert-slug-success"+lang).removeClass("d-none");
		}
		else if(result == 0)
		{
			$("#alert-slug-danger"+lang).removeClass("d-none");
			$("#alert-slug-success"+lang).addClass("d-none");
		}
		else if(result == 2)
		{
			$("#alert-slug-danger"+lang).addClass("d-none");
			$("#alert-slug-success"+lang).addClass("d-none");
		}
	}
	function slugCheck()
	{
		var sluglang = "vi,en";
		var slugInput = $('.slug-input');
		var id = $('.slug-id').val();
		var copy = $('.slug-copy').val();

		slugInput.each(function(index){
			var slugId = $(this).attr('id');
			var slug = $(this).val();
			var lang = slugId.substr(slugId.length-2);
			if(sluglang.indexOf(lang)>=0)
			{
				if(slug)
				{
					$.ajax({
						url: 'ajax/ajax_slug.php',
						type: 'POST',
						dataType: 'html',
						async: false,
						data: {slug:slug,id:id,copy:copy},
						success: function(result){
							slugAlert(result,lang);
						}
					});
				}
			}
		});
	}

	/* Reader image */
	function readImage(inputFile,elementPhoto)
	{
		if(inputFile[0].files[0])
		{
			if(inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif)$/i))
			{
				var size = parseInt(inputFile[0].files[0].size) / 1024;

				if(size <= 4096)
				{
					var reader = new FileReader();
					reader.onload = function(e){
						$(elementPhoto).attr('src', e.target.result);
					}
					reader.readAsDataURL(inputFile[0].files[0]);
				}
				else
				{
					notifyDialog("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB");
					return false;
				}
			}
			else
			{
				notifyDialog("Hình ảnh không hợp lệ");
				return false;
			}
		}
		else
		{
			notifyDialog("Dữ liệu không hợp lệ");
			return false;
		}
	}

	/* Photo zone */
	function photoZone(eDrag,iDrag,eLoad)
	{
		if($(eDrag).length)
		{
			/* Drag over */
			$(eDrag).on("dragover",function(){
				$(this).addClass("drag-over");
				return false;
			});

			/* Drag leave */
			$(eDrag).on("dragleave",function(){
				$(this).removeClass("drag-over");
				return false;
			});

			/* Drop */
			$(eDrag).on("drop",function(e){
				e.preventDefault();
				$(this).removeClass("drag-over");

				var lengthZone = e.originalEvent.dataTransfer.files.length;

				if(lengthZone == 1)
				{
					$(iDrag).prop("files", e.originalEvent.dataTransfer.files);
					readImage($(iDrag),eLoad);
				}
				else if(lengthZone > 1)
				{
					notifyDialog("Bạn chỉ được chọn 1 hình ảnh để upload");
					return false;
				}
				else
				{
					notifyDialog("Dữ liệu không hợp lệ");
					return false;
				}
			});

			/* File zone */
			$(iDrag).change(function(){
				readImage($(this),eLoad);
			});
		}
	}

	/* Watermark */
	function toDataURL(url, callback)
	{
		var xhr = new XMLHttpRequest();
		xhr.onload = function()
		{
			var reader = new FileReader();
			reader.onloadend = function()
			{
				callback(reader.result);
			}
			reader.readAsDataURL(xhr.response);
		};
		xhr.open('GET', url);
		xhr.responseType = 'blob';
		xhr.send();
	}
	function previewWatermark()
	{
		$o = $("#form-watermark");
		var formData = new FormData();
		formData.append('file', $('#file')[0].files[0]);
		formData.append('data', $o.serialize());

		$.ajax({
			type:'POST',
			url: "index.php?com=photo&act=save-watermark&type=<?=(isset($type) && $type != '') ? $type : ''?>",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(data){
				Swal.fire({
					imageUrl: "assets/images/ajax-loader.gif",
					customClass: {
						confirmButton: 'btn btn-sm bg-gradient-primary text-sm',
					},
					buttonsStyling: false,
					confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
					showClass: {
						popup: 'animated fadeInDown faster'
					},
					hideClass: {
						popup: 'animated fadeOutUp faster'
					}
				})

				toDataURL('index.php?com=photo&act=preview-watermark&type=<?=(isset($type) && $type != '') ? $type : ''?>&position='+data.position+'&img='+data.image+'&watermark='+data.path+'&upload='+data.upload+'&opacity='+data.data.opacity+'&per='+data.data.per+'&small_per='+data.data.small_per+'&min='+data.data.min+'&max='+data.data.max+"&t="+data.time, function(dataUrl){$(".swal2-image").attr("src", dataUrl);})
			},
			error: function(data){
				console.log("error");
			}
		});
		
		return false;
	}

	$(document).ready(function(){
		/* Select 2 */
		$('.select2').select2();

		/* Format price */
		$(".format-price").priceFormat({
			limit: 13,
			prefix: '',
			centsLimit: 0
		});

		/* PhotoZone */
		photoZone("#photo-zone","#file-zone","#photoUpload-preview img");

		/* Sumoselect */
		window.asd = $('.multiselect').SumoSelect({
			selectAll: true,
			search: true,
			searchText: 'Tìm kiếm'
		});

		/* Ckeditor */
		$(".form-control-ckeditor").each(function(){
			var id = $(this).attr("id");
			CKEDITOR.replace(id);
		})

		/* Ajax category */
		$('body').on('change','.select-category', function(){
			var id = $(this).val();
			var child = $(this).data("child");
			var level = parseInt($(this).data('level'));
			var table = $(this).data('table');
			var type = $(this).data('type');

			if($("#"+child).length)
			{
				$.ajax({
					url: 'ajax/ajax_category.php',
					type: 'POST',
					data: {level:level,id:id,table:table,type:type},
					success: function(result)
					{
						var op = "<option value='0'>Chọn danh mục</option>";

						if(level == 0)
						{
							$("#id_cat").html(op);
							$("#id_item").html(op);
							$("#id_sub").html(op);
						}
						else if(level == 1)
						{
							$("#id_item").html(op);
							$("#id_sub").html(op);
						}
						else if(level == 2)
						{
							$("#id_sub").html(op);
						}
						$("#"+child).html(result);
					}
				});

				return false;
			}
		});

		/* Ajax place */
		$('body').on('change','.select-place', function(){
			var id = $(this).val();
			var child = $(this).data("child");
			var level = parseInt($(this).data('level'));
			var table = $(this).data('table');

			if($("#"+child).length)
			{
				$.ajax({
					url: 'ajax/ajax_place.php',
					type: 'POST',
					data: {level:level,id:id,table:table},
					success: function(result)
					{
						var op = "<option value='0'>Chọn danh mục</option>";

						if(level == 0)
						{
							$("#id_district").html(op);
							$("#id_wards").html(op);
							$("#id_street").html(op);
						}
						else if(level == 1)
						{
							$("#id_wards").html(op);
							$("#id_street").html(op);
						}
						$("#"+child).html(result);
					}
				});
			}

			return false;
		});

		/* Check required form */
		$('.submit-check').click(function(event){
			var $this;

			/* Holdon */
			holdonOpen("sk-rect","Vui lòng chờ...","rgba(0,0,0,0.8)","white");

			/* Check slug */
			slugCheck();

			/* Check slug danger */
			var elementSlug = $('.card-slug .text-danger:not(.d-none)');
			if(elementSlug.length)
			{
				elementSlug.each(function(){
					$this = $(this);
					var closest = elementSlug.closest('.tab-pane');
					var id = closest.attr('id');

					$('.nav-tabs a[href="#'+id+'"]').tab('show');

					return false;
				});
				
				setTimeout(function(){
					$('html,body').animate({scrollTop: $this.offset().top - 110},'medium');
				},500);

				holdonClose();

				return false;
			}

			/* Check input empty */
			var elementArticle = $('.card-article :required:invalid');
			if(elementArticle.length)
			{
				if($('.card').hasClass('collapsed-card'))
				{
					$('.card.collapsed-card .card-body').show();
					$('.card.collapsed-card .btn-tool i').toggleClass('fas fa-plus fas fa-minus');
					$('.card.collapsed-card').removeClass('collapsed-card');
				}

				elementArticle.each(function(){
					$this = $(this);
					var closest = elementArticle.closest('.tab-pane');
					var id = closest.attr('id');

					$('.nav-tabs a[href="#'+id+'"]').tab('show');

					return false;
				});
				
				setTimeout(function(){
					$('html,body').animate({scrollTop: $this.offset().top - 90},'medium');
				},500);

				holdonClose();
			}

			holdonClose();
		});

	    /* Push oneSignal */
		$('body').on('click','#push-onesignal', function(){
			var url = $(this).data("url");
			confirmDialog("push-onesignal","Bạn muốn đẩy tin này ?",url);
	    });

	    /* Send email */
		$('body').on('click','#send-email', function(){
			confirmDialog("send-email","Bạn muốn gửi thông tin cho các mục đã chọn ?","");
	    });

	    /* Check item */
	    var lastChecked = null;
	    var $checkboxItem = $(".select-checkbox");

	    $checkboxItem.click(function(e){
	    	if(!lastChecked)
	    	{
	    		lastChecked = this;
	    		return;
	    	}

	    	if(e.shiftKey)
	    	{
	    		var start = $checkboxItem.index(this);
	    		var end = $checkboxItem.index(lastChecked);
	    		$checkboxItem.slice(Math.min(start, end), Math.max(start, end) + 1).prop('checked', true);
	    	}

	    	lastChecked = this;
	    });

		/* Check all */
		$('body').on('click','#selectall-checkbox', function(){
			var parentTable = $(this).parents('table');
			var input = parentTable.find('input.select-checkbox');

			if($(this).is(':checked'))
			{
				input.each(function(){
					$(this).prop('checked',true);
				});
			}
			else
			{
				input.each(function(){
					$(this).prop('checked',false); 
				});
			}
		});

	    /* Delete item */
		$('body').on('click','#delete-item', function(){
			var url = $(this).data("url");
			confirmDialog("delete-item","Bạn có chắc muốn xóa mục này ?",url);
	    });

	    /* Delete all */
		$('body').on('click','#delete-all', function(){
			var url = $(this).data("url");
			confirmDialog("delete-all","Bạn có chắc muốn xóa những mục này ?",url);
	    });

		/* Load name input file */
		$('body').on('change','.custom-file input[type=file]', function(){
			var fileName = $(this).val();
			fileName = fileName.substr(fileName.lastIndexOf('\\') + 1, fileName.length);
			$(this).siblings('label').html(fileName);
			$(this).parents("div.form-group").children(".change-photo").find("b.text-sm").html(fileName);
			$(this).parents("div.form-group").children(".change-file").find("b.text-sm").html(fileName);
		});

		/* Change status */
		$('body').on('click','.show-checkbox',function(){
			var id = $(this).attr('data-id');
			var table = $(this).attr('data-table');
			var loai = $(this).attr('data-loai');
			var $this = $(this);

			$.ajax({
				url: 'ajax/ajax_status.php',
				type: 'POST',
				dataType: 'html',
				data: {id:id,table:table,loai:loai},
				success: function()
				{
					if($this.is(':checked')) $this.prop('checked',false);
					else $this.prop('checked',true); 
				}
			});

			return false;
		})

		/* Change stt */
		$('body').on("change","input.update-stt",function(){
			var id = $(this).attr('data-id');
			var table = $(this).attr('data-table');
			var value = $(this).val();

			$.ajax({
				url: 'ajax/ajax_stt.php',
				type: 'POST',
				dataType: 'html',
				data: {id:id,table:table,value:value}
			});

			return false;
		})

		/* Watermark */
		$(".watermark-position label").click(function(){
			if($(".change-photo img").length)
			{
				var img = $(".change-photo img").attr("src");
				if(img)
				{
					$(".watermark-position label img").attr("src","assets/images/noimage.png");
					$(this).find("img").attr("src",img);
					$(this).find("img").show();
				}
			}
			else
			{
				notifyDialog("Dữ liệu hình ảnh không hợp lệ");
				return false;
			}
		})

		/* Slug */
		slugPress();
		$('body').on("click","#slugchange",function(){
			slugChange($(this));
		})

		/* SEO */
		seoChange();
		$('body').on("keyup",".title-seo, .keywords-seo, .description-seo",function(){
			seoCount($(this));
		})
		$('body').on("click",".create-seo",function(){
			if(seoExist()) confirmDialog("create-seo","Nội dung SEO đã được thiết lập. Bạn muốn tạo lại nội dung SEO ?","");
			else seoCreate();
		})

		/* Copy */
		$('body').on("click",".copy-now",function(){
			var id = $(this).attr('data-id');
			var table = $(this).attr('data-table');
			var copyimg = $(this).attr('data-copyimg');

			holdonOpen("sk-rect","Vui lòng chờ...","rgba(0,0,0,0.8)","white");
			$.ajax({
				url: 'ajax/ajax_copy.php',
				type: 'POST',
				dataType: 'html',
				async: false,
				data: {id:id,table:table,copyimg:copyimg},
				success: function(){
					holdonClose();
				}
			});

			window.location.reload(true);
		})

		<?php if(isset($flagGallery) && $flagGallery == true && isset($gallery) && count($gallery) > 0) { ?>
			/* Sort filer */
			createSortFiler();
		<?php } ?>

		/* Check all filer */
		$('body').on('click','.check-all-filer', function(){
			var parentFiler = $(".my-jFiler-items .jFiler-items-list");
			var input = parentFiler.find('input.filer-checkbox');
			var jFilerItems = $("#jFilerSortable").find('.my-jFiler-item');

			$(this).find("i").toggleClass("far fa-square fas fa-check-square");
			if($(this).hasClass('active'))
			{
				$(this).removeClass('active');
				$(".sort-filer").removeClass("active");
				$(".sort-filer").attr('disabled',false);
				input.each(function(){
					$(this).prop('checked',false); 
				});
			}
			else
			{
				sortable.option("disabled",true);
				$(this).addClass('active');
				$(".sort-filer").attr('disabled',true);
				$(".alert-sort-filer").hide();
				$(".my-jFiler-item-trash").show();
				input.each(function(){
					$(this).prop('checked',true);
				});
				jFilerItems.each(function(){
					$(this).find('input').attr('disabled',false);
				});
				jFilerItems.each(function(){
					$(this).removeClass('moved');
				});
			}
		});
		
		/* Check filer */
		$('body').on('click','.filer-checkbox',function(){
			var input = $(".my-jFiler-items .jFiler-items-list").find('input.filer-checkbox:checked');

			if(input.length) $(".sort-filer").attr('disabled',true);
			else $(".sort-filer").attr('disabled',false);
		})

		/* Sort filer */
		$('body').on('click','.sort-filer', function(){
			var jFilerItems = $("#jFilerSortable").find('.my-jFiler-item');

			if($(this).hasClass('active'))
			{
				sortable.option("disabled",true);
				$(this).removeClass('active');
				$(".alert-sort-filer").hide();
				$(".my-jFiler-item-trash").show();
				jFilerItems.each(function(){
					$(this).find('input').attr('disabled',false);
					$(this).removeClass('moved');
				});
			}
			else
			{
				sortable.option("disabled",false);
				$(this).addClass('active');
				$(".alert-sort-filer").show();
				$(".my-jFiler-item-trash").hide();
				jFilerItems.each(function(){
					$(this).find('input').attr('disabled',true);
					$(this).addClass('moved');
				});
			}
		});

		/* Delete filer */
		$("body").on("click",".my-jFiler-item-trash",function(){
			var id = $(this).data("id");
			var folder = $(this).data("folder");
			var str = id+","+folder;
			confirmDialog("delete-filer","Bạn có chắc muốn xóa hình ảnh này ?",str);
        });

        /* Delete all filer */
		$("body").on("click",".delete-all-filer",function(){
			var folder = $(".folder-filer").val();
			confirmDialog("delete-all-filer","Bạn có chắc muốn xóa các hình ảnh đã chọn ?",folder);
        });

        /* Hash upload multi filer */
		$("form.validation-form").append('<input type="hidden" name="hash" value="<?=$func->generateHash()?>" />');
		$("#filer-gallery").attr({'data-params':'<?=base64_encode($_SERVER['QUERY_STRING'])?>','data-hash':'<?=$func->generateHash()?>'});

        /* Change info filer */
        $('body').on('change','.my-jFiler-item-info', function(){
			var id = $(this).data("id");
			var info = $(this).data("info");
			var value = $(this).val();
			var idmuc = <?=(isset($id) && $id > 0) ? $id : 0?>;
			var com = '<?=(isset($com) && $com != '') ? $com : ''?>';
			var kind = '<?=(isset($act) && $act != '') ? $act : ''?>';
			var type = '<?=(isset($type) && $type != '') ? $type : ''?>';
			var colfiler = $(".col-filer").val();
			var actfiler = $(".act-filer").val();
			var cmd = 'info';

			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'ajax/ajax_filer.php',
				async: false,
				data: {id:id,idmuc:idmuc,info:info,value:value,com:com,kind:actfiler,type:type,colfiler:colfiler,cmd:cmd,hash:'<?=$func->generateHash()?>'},
				success: function(result)
				{
					destroySortFiler();
					$("#jFilerSortable").html(result);
					createSortFiler();
				}
			});

			return false;
        });

		/* Filer */
		$("#filer-gallery").filer({
            limit: null,
            maxSize: null,
            extensions: ["jpg","png","jpeg","JPG","PNG","JPEG","Png"],
            changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Kéo và thả hình vào đây</h3> <span style="display:inline-block; margin: 15px 0">hoặc</span></div><a class="jFiler-input-choose-btn blue">Chọn hình</a></div></div>',
			theme: "dragdropbox",
            showThumbs: true,
            addMore: true,
            allowDuplicates: false,
            clipBoardPaste: false,
            dragDrop: {
				dragEnter: null,
				dragLeave: null,
				drop: null,
				dragContainer: null
            },
            captions: {
                button: "Thêm hình",
                feedback: "Vui lòng chọn hình ảnh",
                feedback2: "Những hình đã được chọn",
                drop: "Kéo hình vào đây để upload",
                removeConfirmation: "Bạn muốn loại bỏ hình ảnh này ?",
                errors: {
                    filesLimit: "Chỉ được upload mỗi lần {{fi-limit}} hình ảnh",
                    filesType: "Chỉ hỗ trợ tập tin là hình ảnh có định dạng: {{fi-extensions}}",
                    filesSize: "Hình {{fi-name}} có kích thước quá lớn. Vui lòng upload hình ảnh có kích thước tối đa {{fi-maxSize}} MB.",
                    filesSizeAll: "Những hình ảnh bạn chọn có kích thước quá lớn. Vui lòng chọn những hình ảnh có kích thước tối đa {{fi-maxSize}} MB."
                }
            },
            afterShow: function(){
            	var jFilerItems = $(".my-jFiler-items .jFiler-items-list li.jFiler-item");
            	var jFilerItemsLength = 0;
            	var jFilerItemsLast = 0;
            	if(jFilerItems.length)
            	{
            		jFilerItemsLength = jFilerItems.length;
            		jFilerItemsLast = parseInt(jFilerItems.last().find("input[type=number]").val());
            	}
            	$(".jFiler-items-list li.jFiler-item").each(function(index){
            		var colClass = $(".col-filer").val();
            		var parent = $(this).parent();
            		if(!parent.is("#jFilerSortable"))
            		{
            			jFilerItemsLast += 1;
	            		$(this).find("input[type=number]").val(jFilerItemsLast);
            		}
	            	if(!$(this).hasClass(colClass)) $("li.jFiler-item").addClass(colClass);
            	});
            },
            uploadFile: {
				url: "ajax/ajax_upload.php",
				data: $("#filer-gallery").data(),
				type: 'POST',
				enctype: 'multipart/form-data',
				dataType: 'json',
				async: false,
				beforeSend: function(){
					holdonOpen("sk-rect","Vui lòng chờ...","rgba(0,0,0,0.8)","white");
				},
				success: function(data, el){
					data = JSON.parse(data);
					if(data['success'] == true)
					{
						var parent = el.find(".jFiler-jProgressBar").parent();
						el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
							$("<div class = \"jFiler-item-others text-success\"><i class = \"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
						});
					}
					else
					{
						var parent = el.find(".jFiler-jProgressBar").parent();
						el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
							$("<div class = \"jFiler-item-others text-error\"><i class = \"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
						});
					}
				},
				error: function(el){
					var parent = el.find(".jFiler-jProgressBar").parent();
					el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
						$("<div class = \"jFiler-item-others text-error\"><i class = \"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
					});
				},
				onComplete: function(){
					refreshFiler();
					if($(".my-jFiler-item-info").length)
					{
						$(".jFiler-items-list").first().find(".jFiler-item").remove();
						$(".my-jFiler-item-info").trigger("change");
					}
					else
					{
						refreshFilerIfEmpty();
					}
					holdonClose();
				},
				statusCode: {},
				onProgress: function(){},
			},
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid row scroll-bar"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-thumb-overlay">\
                                            <div class="jFiler-item-info">\
                                                <div style="display:table-cell;vertical-align: middle;">\
                                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
                                                </div>\
                                            </div>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li>{{fi-progressBar}}</li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                    <input type="number" class="form-control form-control-sm mb-1" name="stt-filer[]" placeholder="Số thứ tự"/>\
                                    <input type="text" class="form-control form-control-sm" name="ten-filer[]" placeholder="Tiêu đề"/>\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                                <div class="jFiler-item-container">\
                                    <div class="jFiler-item-inner">\
                                        <div class="jFiler-item-thumb">\
                                            <div class="jFiler-item-status"></div>\
                                            <div class="jFiler-item-thumb-overlay">\
                                                <div class="jFiler-item-info">\
                                                    <div style="display:table-cell;vertical-align: middle;">\
                                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            {{fi-image}}\
                                        </div>\
                                        <div class="jFiler-item-assets jFiler-row">\
                                            <ul class="list-inline pull-left">\
                                                <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                            </ul>\
                                            <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                            </ul>\
                                        </div>\
                                        <input type="number" class="form-control form-control-sm mb-1" name="stt-filer[]" placeholder="Số thứ tự"/>\
                                    	<input type="text" class="form-control form-control-sm" name="ten-filer[]" placeholder="Tiêu đề"/>\
                                    </div>\
                                </div>\
                            </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                canvasImage: false,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-items-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action'
                }
            }
        });

		/* Filer import */
		$("#filer-import").filer({
            limit: null,
            maxSize: null,
            extensions: ["jpg","png","jpeg","JPG","PNG","JPEG","Png"],
            changeInput: '<a class="jFiler-input-choose-btn border-primary btn btn-sm bg-gradient-primary text-white mb-3"><i class="fas fa-cloud-upload-alt mr-2"></i>Upload hình ảnh</a>',
			theme: "default",
            showThumbs: true,
            addMore: true,
            allowDuplicates: false,
            clipBoardPaste: false,
            captions: {
                button: "Thêm hình",
                feedback: "Vui lòng chọn hình ảnh",
                feedback2: "Những hình đã được chọn",
                drop: "Kéo hình vào đây để upload",
                removeConfirmation: "Bạn muốn loại bỏ hình ảnh này ?",
                errors: {
                    filesLimit: "Chỉ được upload mỗi lần {{fi-limit}} hình ảnh",
                    filesType: "Chỉ hỗ trợ tập tin là hình ảnh có định dạng: {{fi-extensions}}",
                    filesSize: "Hình {{fi-name}} có kích thước quá lớn. Vui lòng upload hình ảnh có kích thước tối đa {{fi-maxSize}} MB.",
                    filesSizeAll: "Những hình ảnh bạn chọn có kích thước quá lớn. Vui lòng chọn những hình ảnh có kích thước tối đa {{fi-maxSize}} MB."
                }
            },
            afterShow: function(){
            	var jFilerItems = $(".my-jFiler-items .jFiler-items-list li.jFiler-item");
            	var jFilerItemsLength = 0;
            	var jFilerItemsLast = 0;
            	if(jFilerItems.length)
            	{
            		jFilerItemsLength = jFilerItems.length;
            		jFilerItemsLast = parseInt(jFilerItems.last().find("input[type=number]").val());
            	}
            	$(".jFiler-items-list li.jFiler-item").each(function(index){
            		var colClass = $(".col-filer").val();
            		var parent = $(this).parent();
            		if(!parent.is("#jFilerSortable"))
            		{
            			jFilerItemsLast += 1;
	            		$(this).find("input[type=number]").val(jFilerItemsLast);
            		}
	            	if(!$(this).hasClass(colClass)) $("li.jFiler-item").addClass(colClass);
            	});
            },
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid row scroll-bar"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-thumb-overlay">\
                                            <div class="jFiler-item-info">\
                                                <div style="display:table-cell;vertical-align: middle;">\
                                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
                                                </div>\
                                            </div>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li>{{fi-progressBar}}</li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                    <input type="number" class="form-control form-control-sm mb-1" name="stt-filer[]" placeholder="Số thứ tự"/>\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                                <div class="jFiler-item-container">\
                                    <div class="jFiler-item-inner">\
                                        <div class="jFiler-item-thumb">\
                                            <div class="jFiler-item-status"></div>\
                                            <div class="jFiler-item-thumb-overlay">\
                                                <div class="jFiler-item-info">\
                                                    <div style="display:table-cell;vertical-align: middle;">\
                                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            {{fi-image}}\
                                        </div>\
                                        <div class="jFiler-item-assets jFiler-row">\
                                            <ul class="list-inline pull-left">\
                                                <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                            </ul>\
                                            <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                            </ul>\
                                        </div>\
                                        <input type="number" class="form-control form-control-sm mb-1" name="stt-filer[]" placeholder="Số thứ tự"/>\
                                    </div>\
                                </div>\
                            </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                canvasImage: false,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-items-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action'
                }
            }
        });
	});
</script>
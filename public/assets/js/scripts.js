(function ($) {
    var dataTable;

    // DataTable Server Side
    dataTableServerSide = (params) => {
        "use strict";

        switch (true) {
            case !params.url:
                console.warn("params.url is required");
                break;
            case !params.columns:
                console.warn("params.columns is required");
                break;
            case !Array.isArray(params.columns):
                console.warn("params.columns must be array");
                break;
        }

        // Setup - add a text input to each footer cell
        $(".table-ssr tfoot th").each(function (i) {
            const title = $(this).text();
            const placeholder = `Cari ${title}`;
            const width = placeholder.length * 7 + 32;
            const type =
                params.columns[i].searchable === false ? "hidden" : "text";

            params.columns[i].name = params.columns[i].field
                ? params.columns[i].field
                : params.columns[i].name;

            $(this).html(
                `<input type="${type}" class="form-control" placeholder="${placeholder}" style="margin: 10px 0px; min-width: ${width}px" />`
            );
        });

        // DataTable
        let payload = params.args ? params.args : {};

        dataTable = $(".table-ssr").DataTable({
            filter: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: params.url + "/list",
                type: "post",
                dataType: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    ...payload,
                },
            },
            columns: params.columns,
            order: [params.order ? params.order : [0, "desc"]],
            // "scrollY":        true,
            // "scrollX":        true,
            // "fixedColumns":   {
            //     "rightColumns": 1
            // },
            language: {
                paginate: {
                    previous: `<i class="bx bx-chevron-left"></i>`,
                    next: `<i class="bx bx-chevron-right"></i>`,
                },
            },
        });

        // Apply the search
        dataTable.columns().every(function () {
            var that = this;

            $("input", this.footer()).on("keyup", function (e) {
                if (
                    (e.key == "Enter" && that.search() !== this.value) ||
                    (e.target.value == "" && that.search() !== this.value)
                ) {
                    that.search(this.value).draw();
                }
            });
        });

        // // Array to track the ids of the details displayed rows
        // var detailRows = [];

        // $('.table-ssr tbody').on( 'click', 'tr td.details-control', function () {
        //     var tr = $(this).closest('tr');
        //     var row = dataTable.row( tr );
        //     var idx = $.inArray( tr.attr('id'), detailRows );

        //     if ( row.child.isShown() ) {
        //         tr.removeClass( 'details' );
        //         row.child.hide();

        //         // Remove from the 'open' array
        //         detailRows.splice( idx, 1 );
        //     }
        //     else {
        //         tr.addClass( 'details' );
        //         row.child( format( row.data() ) ).show();

        //         // Add to the 'open' array
        //         if ( idx === -1 ) {
        //             detailRows.push( tr.attr('id') );
        //         }
        //     }
        // } );

        // // On each draw, loop over the `detailRows` array and show any child rows
        // dataTable.on( 'draw', function () {
        //     $.each( detailRows, function ( i, id ) {
        //         $('#'+id+' td.details-control').trigger( 'click' );
        //     } );
        // } );
        // function format ( d ) {
        //   console.log(d)
        //   return 'The child row can contain any data you wish, including links, images, inner tables etc.';
        // }
    };

    // Confirmaion Delete
    confirmDelete = (params) => {
        "use strict";
        let name = "";
        if (params.name) {
            name = params.name;
        }

        Swal.fire({
            title: "Konfirmasi",
            text: `Anda Ingin Menghapus ${name} ?`,
            type: "warning",
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false,
            preConfirm: function () {
                return fetch(params.url + "/" + params.id, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                })
                    .then(function (response) {
                        if (!response.ok) {
                            console.log(response);
                            throw new Error(response.statusText);
                        }

                        return response.json();
                    })
                    .catch(function (error) {
                        Swal.showValidationMessage(
                            "Request failed:  " + error + ""
                        );
                    });
            },
            allowOutsideClick: function () {
                !Swal.isLoading();
            },
        }).then(function (result) {
            if (result.value) {
                switch (result.value.status) {
                    case 200:
                        toastr.success("Data berhasil dihapus !", "Sukses", {
                            progressBar: true,
                            showDuration: 500,
                            closeButton: true,
                        });
                        setTimeout(() => {
                            if (params.reload) {
                                dataTable.ajax.reload();
                                // window.location.reload()
                            } else {
                                params.tr.remove();
                            }
                        }, 500);
                        break;
                    case 500:
                        toastr.error(
                            "Data tidak bisa dihapus, karena sudah digunakan !",
                            "Gagal",
                            {
                                progressBar: true,
                                showDuration: 500,
                                closeButton: true,
                            }
                        );
                        break;
                }
            }
        });
    };

    confirmDeleteLogs = (params) => {
        "use strict";
        let uuid =params.id;

        Swal.fire({
            title: "Konfirmasi",
            text: `Anda Ingin Menghapus Order ${uuid} ?`,
            type: "warning",
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false,
            preConfirm: function () {
                return fetch(params.url + "/" + uuid, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                })
                    .then(function (response) {
                        if (!response.ok) {
                            console.log(response);
                            throw new Error(response.statusText);
                        }

                        return response.json();
                    })
                    .catch(function (error) {
                        Swal.showValidationMessage(
                            "Request failed:  " + error + ""
                        );
                    });
            },
            allowOutsideClick: function () {
                !Swal.isLoading();
            },
        }).then(function (result) {
            if (result.value) {
                switch (result.value.status) {
                    case 200:
                        toastr.success("Data berhasil dihapus !", "Sukses", {
                            progressBar: true,
                            showDuration: 500,
                            closeButton: true,
                        });
                        setTimeout(() => {
                            if (params.reload) {
                                dataTable.ajax.reload();
                                // window.location.reload()
                            } else {
                                params.tr.remove();
                            }
                        }, 500);
                        break;
                    case 500:
                        toastr.error(
                            "Data tidak bisa dihapus, karena sudah digunakan !",
                            "Gagal",
                            {
                                progressBar: true,
                                showDuration: 500,
                                closeButton: true,
                            }
                        );
                        break;
                }
            }
        });
    };

    confirmResetPassword = (params) => {
        "use strict";
        let name = "";
        if (params.name) {
            name = params.name;
        }

        Swal.fire({
            title: "Konfirmasi",
            html: `Anda Ingin Mereset Password ${name} ?
          <br>jika ya password anda 12345678
          `,

            type: "warning",
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false,
            preConfirm: function () {
                return fetch(params.url + "/" + params.id + "/reset-password", {
                    method: "GET",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                })
                    .then(function (response) {
                        if (!response.ok) {
                            console.log(response);
                            throw new Error(response.statusText);
                        }

                        return response.json();
                    })
                    .catch(function (error) {
                        Swal.showValidationMessage(
                            "Request failed:  " + error + ""
                        );
                    });
            },
            allowOutsideClick: function () {
                !Swal.isLoading();
            },
        }).then(function (result) {
            if (result.value) {
                switch (result.value.status) {
                    case 200:
                        toastr.success(
                            "Data berhasil reset password !",
                            "Sukses",
                            {
                                progressBar: true,
                                showDuration: 500,
                                closeButton: true,
                            }
                        );
                        setTimeout(() => {
                            if (params.reload) {
                                dataTable.ajax.reload();
                                // window.location.reload()
                            }
                        }, 500);
                        break;
                    case 500:
                        toastr.error(
                            "Data tidak bisa dihapus, karena sudah digunakan !",
                            "Gagal",
                            {
                                progressBar: true,
                                showDuration: 500,
                                closeButton: true,
                            }
                        );
                        break;
                }
            }
        });
    };

    removeDuplicates = (array, key) => {
        return array.reduce((arr, item) => {
            const removed = arr.filter((i) => i[key] !== item[key]);
            return [...removed, item];
        }, []);
    };

    setInputFilter = (textbox, inputFilter, errMsg) => {
        [
            "input",
            "keydown",
            "keyup",
            "mousedown",
            "mouseup",
            "select",
            "contextmenu",
            "drop",
            "focusout",
        ].forEach(function (event) {
            textbox.addEventListener(event, function (e) {
                if (inputFilter(this.value)) {
                    // Accepted value
                    if (
                        ["keydown", "mousedown", "focusout"].indexOf(e.type) >=
                        0
                    ) {
                        this.classList.remove("input-error");
                        this.setCustomValidity("");
                    }
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    // Rejected value - restore the previous one
                    this.classList.add("input-error");
                    this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(
                        this.oldSelectionStart,
                        this.oldSelectionEnd
                    );
                } else {
                    // Rejected value - nothing to restore
                    this.value = "";
                }
            });
        });
    };

    // Submit Form
    $(document).on("click", "#btn-save", function (e) {
        e.preventDefault();
        $(".form-submit").trigger("submit");
    });

    // Show hide password
    $(document).on("click", ".show-hide-password", function (e) {
        const type =
            $("#password").attr("type") == "password" ? "text" : "password";
        const icon =
            $("#password").attr("type") == "password" ? "eye-slash" : "eye";

        $("#password").attr("type", type);
        $(this)
            .children("img")
            .attr(
                "src",
                `https://icongr.am/fontawesome/${icon}.svg?size=16&color=696969`
            );
    });
})(jQuery);

var bet = {
    odds: {
        sync: function () {
            $(".odds-sync").attr("disabled", "disabled");
            $.post(admin_url + MODULE_NAME + '/admin/sync/' + MODULE_ODDS, {}, function (e) {
                var a = JSON.parse(e);
                if (a.return) {
                    alert_float('success', a.message);
                    $('.table-' + MODULE_ODDS + '-sports').DataTable().ajax.reload();
                }
                else {
                    alert_float('danger', a.message);
                }
            });
            $(".odds-sync").removeAttr('disabled');
        },
        add: function (data) {
            $.post(admin_url + MODULE_NAME + '/admin/modal/' + MODULE_ODDS, data, function (a) {
                var e = JSON.parse(a);
                if (e.return) {
                    $("#" + MODULE_MODAL).html(e.data);
                    $("#sports_add_modal").modal('show');
                    $('.selectpicker').selectpicker('refresh');
                }
                else {
                    alert_float('danger', e.message);
                }
            });
        },
        bet: function (data) {
            $.post(admin_url + MODULE_NAME + '/admin/sync/bet', data, function (a) {
                var e = JSON.parse(a);
                if (e.return) {
                    alert_float('success', e.message);
                    $('.modal-backdrop').removeClass('modal-backdrop');
                    bet.view(data.id);
                }
                else {
                    alert_float('danger', e.message);
                }
            });
        },
        delete: function (data) {
            $.post(admin_url + MODULE_NAME + '/admin/sync/delete', data, function (a) {
                var e = JSON.parse(a);
                if (e.return) {
                    alert_float('success', e.message);
                    $('.modal-backdrop').removeClass('modal-backdrop');
                    bet.view(data.id);
                }
                else {
                    alert_float('danger', e.message);
                }
            });
        }
    },
    sync: function (id, data = {}) {
        switch (id) {
            case MODULE_ODDS:
                this.odds.sync();
                break;
            case 'bet':
                this.odds.bet(data);
                break;
            case 'delete':
                this.odds.delete(data);
                break;
            default:
                break;
        }
    },
    filter: function (val, id, table = '') {
        $('#' + id).val(val);
        if (table != '') {
            $('.' + table).DataTable().ajax.reload();
        }
    },
    sports: function (id, data = {}) {
        switch (id) {
            case MODULE_ODDS:
                this.odds.add(data);
                break;

            default:
                break;
        }
    },
    common_delete: function (link) {
        if (confirm('Are you sure?') == true) {
            window.location.href = link;
        } else {
            return false;
        }
    },
    common_status: function (link) {
        $.ajax({
            type: "post",
            url: link,
            dataType: "json",
            success: function (data) {
                alert_float('success', data);
            }
        });
    },
    view: function (i) {
        $.post(admin_url + MODULE_NAME + '/admin/modal/viewBet', { id: i }, function (a) {
            var e = JSON.parse(a);
            if (e.return) {
                $("#" + MODULE_MODAL).html(e.data);
                $("#sports_view_modal").modal('show');
                $('.selectpicker').selectpicker('refresh');
            }
            else {
                alert_float('danger', e.message);
            }
        });
    },
    winloss: function (i) {
        $.post(admin_url + MODULE_NAME + '/admin/modal/winLoss', { id: i }, function (a) {
            var e = JSON.parse(a);
            if (e.return) {
                $("#" + MODULE_MODAL).html(e.data);
                $("#winloss_modal").modal('show');
                $('.selectpicker').selectpicker('refresh');
            }
            else {
                alert_float('danger', e.message);
            }
        });
    },
    manual: function (sports_id, sports_key, id) {
        $('#sports_id').val(sports_id);
        $('#sports_key').val(sports_key);
        $('#bet_id').val(id);
        $("#sports_manual_modal").modal('show');
    },
    manual_save: function () {
        var title = $('#title').val(), name = $('#name').val(), price = $('#price').val(),
            sports_id = $('#sports_id').val(),
            sports_key = $('#sports_key').val(),
            id = $('#bet_id').val();
        if (title.length > 0 && name.length > 0 && price.length > 0) {
            $.post(admin_url + MODULE_NAME + '/admin/menual', { title: title, name: name, price: price, sports_id: sports_id, sports_key: sports_key, id: id }, function (a) {
                var e = JSON.parse(a);
                if (e.return) {
                    alert_float('success', e.message);
                    $('.modal-backdrop').removeClass('modal-backdrop');
                    bet.view(id);
                }
                else {
                    alert_float('danger', e.message);
                }
            });
        }
        else {
            alert_float('danger', 'type title,name and price.');
        }
    },
    del_bookmark: function (sid, mid, b) {
        if (confirm("are you sure delete this data?")) {
            $.post(admin_url + MODULE_NAME + '/admin/delete/bookmark', { sports_id: sid, main_id: mid, bookmark_id: b }, function (e) {
                $('.modal-backdrop').removeClass('modal-backdrop');
                bet.view(sid);
            });
        }
    },
    del_market: function (sid, mid, b, m) {
        if (confirm("are you sure delete this data?")) {
            $.post(admin_url + MODULE_NAME + '/admin/delete/market', { sports_id: sid, main_id: mid, bookmark_id: b, market_id: m }, function (e) {
                $('.modal-backdrop').removeClass('modal-backdrop');
                bet.view(sid);
            });
        }
    },
    edit_bookmark: function (sid, mid, b, name) {
        let data = prompt("Please change your bookmark name.", name);
        if (data.length > 0) {
            $.post(admin_url + MODULE_NAME + '/admin/edit/bookmark', { sports_id: sid, main_id: mid, bookmark_id: b, name: data }, function (e) {
                $('.modal-backdrop').removeClass('modal-backdrop');
                bet.view(sid);
            });
        }
    },
    edit_market: function (sid, mid, b, m, n) {
        let data = prompt("Please change your market name.", n);
        if (data.length > 0) {
            $.post(admin_url + MODULE_NAME + '/admin/edit/market', { sports_id: sid, main_id: mid, bookmark_id: b, market_id: m, name: data }, function (e) {
                $('.modal-backdrop').removeClass('modal-backdrop');
                bet.view(sid);
            });
        }
    },
    edit_market_price: function (sid, mid, b, m, n) {
        let data = prompt("Please change your price.", n);
        if (data.length > 0) {
            $.post(admin_url + MODULE_NAME + '/admin/edit/market_price', { sports_id: sid, main_id: mid, bookmark_id: b, market_id: m, name: data }, function (e) {
                $('.modal-backdrop').removeClass('modal-backdrop');
                bet.view(sid);
            });
        }
    },
    default: function () {

    }
};
bet.default();
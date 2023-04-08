var BootstrapDatepicker = function () {
    var t;
    t = mUtil.isRTL() ? {leftArrow: '<i class="la la-angle-right"></i>', rightArrow: '<i class="la la-angle-left"></i>'} : {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
    return {
        init: function () {
            $("#m_datepicker_1, #m_datepicker_1_validate").datepicker({rtl: mUtil.isRTL(), todayHighlight: !0, orientation: "bottom left", templates: t}), $("#m_datepicker_1_modal").datepicker({rtl: mUtil.isRTL(), todayHighlight: !0, orientation: "bottom left", templates: t}), $("#m_datepicker_2, #m_datepicker_2_validate").datepicker({rtl: mUtil.isRTL(), todayHighlight: !0, orientation: "bottom left", templates: t}), $("#m_datepicker_2_modal").datepicker({rtl: mUtil.isRTL(), todayHighlight: !0, orientation: "bottom left", templates: t}), $("#m_datepicker_3, #m_datepicker_3_validate").datepicker({rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, templates: t}), $("#m_datepicker_3_modal").datepicker({rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, templates: t}), $("#m_datepicker_4_1").datepicker({rtl: mUtil.isRTL(), orientation: "top left", todayHighlight: !0, templates: t}), $("#m_datepicker_4_2").datepicker({
                rtl: mUtil.isRTL(),
                orientation: "top right",
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_4_3").datepicker({rtl: mUtil.isRTL(), orientation: "bottom left", todayHighlight: !0, templates: t}), $("#m_datepicker_4_4").datepicker({rtl: mUtil.isRTL(), orientation: "bottom right", todayHighlight: !0, templates: t}), $("#m_datepicker_5").datepicker({rtl: mUtil.isRTL(), todayHighlight: !0, templates: t}), $("#m_datepicker_6").datepicker({rtl: mUtil.isRTL(), todayHighlight: !0, templates: t})
        }
    }
}();
jQuery(document).ready(function () {
    BootstrapDatepicker.init()
});
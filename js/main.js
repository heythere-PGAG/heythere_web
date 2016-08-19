jQuery(function(e) {
    $(document).ready(function() {
        var n, o, s, a, i, r = navigator.userAgent,
            c = e(window).width(),
            l = {
                iphone: r.match(/(iPhone|iPod|iPad)/),
                blackberry: r.match(/BlackBerry/),
                android: r.match(/Android/)
            };
        if (s = -1 != navigator.userAgent.indexOf("Safari") && -1 == navigator.userAgent.indexOf("Chrome") ? !0 : !1, o = -1 !== navigator.userAgent.indexOf("MSIE") || navigator.appVersion.indexOf("Trident/") > 0 ? !0 : !1, n = l.android || l.iphone || l.blackberry ? !0 : !1, a = 1145 > c ? !0 : !1, i = c >= 960 ? !0 : !1, i && window.ScrollMagic) {
            var u = new ScrollMagic,
                f = "assets/gfx/temp/subject-entry.54ee6a86.png",
                d = ["assets/gfx/temp/d1.e06aa4c6.png", "assets/gfx/temp/d2.06b27257.png", "assets/gfx/temp/d3.e06aa4c6.png", "assets/gfx/temp/d2.06b27257.png"],
                h = ["assets/gfx/temp/d1-90.e136f271.png", "assets/gfx/temp/d2-90.a4b22c82.png", "assets/gfx/temp/d3-90.f7624d27.png", "assets/gfx/temp/d2-90.a4b22c82.png"],
                m = (new TimelineMax).add([TweenMax.to(".js-subject", 1, {
                    left: "58px",
                    top: "142px"
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "56px",
                    top: "140px",
                    onStart: function() {
                        e(".js-subject").attr("src", h[0]), e(".js-showroomHand").stop().fadeIn(), e('[class*="js-showroomPhone"]').stop().fadeIn()
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "172px",
                    top: "223px",
                    onStart: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneWelcome").addClass("isActive")
                    },
                    onReverseComplete: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-subject").attr("src", f), e(".js-showroomHand").stop().fadeOut(), e('[class*="js-showroomPhone"]').stop().fadeOut()
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "328px",
                    top: "143px",
                    onStart: function() {
                        e(".js-subject").attr("src", d[0]), e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneMap1").addClass("isActive")
                    },
                    onReverseComplete: function() {
                        e(".js-subject").attr("src", h[0]), e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneWelcome").addClass("isActive")
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "423px",
                    top: "191px",
                    onStart: function() {
                        e(".js-subject").attr("src", h[0])
                    },
                    onReverseComplete: function() {
                        e(".js-subject").attr("src", d[0])
                    }
                })]).add([TweenMax.to(".js-subject", 1.5, {
                    left: "423px",
                    top: "191px",
                    onStart: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneItem1").addClass("isActive"), e(".js-showroomTv").stop().fadeIn(), e(".js-item1").stop().fadeIn()
                    },
                    onReverseComplete: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneMap1").addClass("isActive"), e(".js-showroomTv").stop().fadeOut(), e(".js-item1").stop().fadeOut()
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "532px",
                    top: "243px",
                    onStart: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneMap2").addClass("isActive"), e(".js-showroomTv").stop().fadeOut(), e(".js-item1").stop().fadeOut()
                    },
                    onReverseComplete: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneItem1").addClass("isActive"), e(".js-showroomTv").stop().fadeIn(), e(".js-item1").stop().fadeIn()
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "742px",
                    top: "154px",
                    onStart: function() {
                        e(".js-subject").attr("src", d[0])
                    },
                    onReverseComplete: function() {
                        e(".js-subject").attr("src", h[0])
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "783px",
                    top: "183px",
                    onStart: function() {
                        e(".js-subject").attr("src", h[0])
                    },
                    onReverseComplete: function() {
                        e(".js-subject").attr("src", d[0])
                    }
                })]).add([TweenMax.to(".js-subject", 1.5, {
                    left: "783px",
                    top: "183px",
                    onStart: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneItem2").addClass("isActive"), e(".js-item2").stop().fadeIn()
                    },
                    onReverseComplete: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneMap1").addClass("isActive"), e(".js-item2").stop().fadeOut()
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "904px",
                    top: "267px",
                    onStart: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhonePayment").addClass("isActive"), e(".js-item2").stop().fadeOut()
                    },
                    onReverseComplete: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneItem2").addClass("isActive"), e(".js-item2").stop().fadeIn()
                    }
                })]).add([TweenMax.to(".js-subject", 1, {
                    left: "922px",
                    top: "280px",
                    onStart: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhoneBye").addClass("isActive")
                    },
                    onReverseComplete: function() {
                        e('[class*="js-showroomPhone"]').removeClass("isActive"), e(".js-showroomPhonePayment").addClass("isActive")
                    }
                })]);
            n || o || s ? (e(".js-appsSliderWrapper").removeClass("u-isHidden"), e(".js-appsSlider").owlCarousel({
                loop: !0,
                items: 1,
                nav: !0,
                dots: !0,
                stickyStage: !0,
                mouseDrag: !0,
                nav: !1,
                onTranslated: function(t) {
                    var n = e(".owl-item.active").find("img").data("slide");
                    e(".js-applicationsMobile").addClass("u-isHiddenVisually").filter("[data-slidebg='" + n + "']").removeClass("u-isHiddenVisually")
                },
                onInitialize: function(t) {
                    e(".owl-item.active").find("img").data("slide"), e(".js-applicationsMobile").addClass("u-isHiddenVisually").filter(":first").removeClass("u-isHiddenVisually")
                }
            }), e(".owl-next").click(function() {
                e(".js-appsSlider").trigger("next.owl.carousel")
            })) : (e(".js-appsAnimationWrapper").removeClass("u-isHidden"), e(".BeaconsInAction").length && new ScrollScene({
                triggerElement: ".BeaconsInAction",
                triggerHook: "onLeave",
                duration: 1200,
                offset: 250
            }).setTween(m).setPin(".BeaconsInAction").addTo(u)), n || a ? e(".js-indoorDemoAnimaFallback").removeClass("u-isHidden") : (e(".js-indoorDemoAnim").removeClass("u-isHidden"), e(".js-subjectIndoor").addClass("indoorAnimation"), e(".js-appSubject").addClass("mobileIndoorAnimation"))
        }
    })
});
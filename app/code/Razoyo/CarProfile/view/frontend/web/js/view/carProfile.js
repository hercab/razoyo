define(
    [
        'uiComponent',
        'ko',
        'jquery',
        'mage/url',
        'mage/storage',
        'Razoyo_CarProfile/js/model/car',
        'Magento_Ui/js/model/messageList'
    ],
    function (Component, ko, $, urlBuilder, storage, carModel, messageList) {
        'use strict';

        return Component.extend({
            default: {},
            initialize: function () {
                this._super();
                if (this.car) {
                    carModel.setData(this.car);
                }
                return this
            },

            getCarData: function (key) {
                return carModel[key]();
            },

            getServiceUrl: function () {
                return this.url;
            },

            saveCarProfile: function (formElement) {
                var self = this
                if ($(formElement).validation() && $(formElement).validation('isValid')) {
                    let serviceUrl = '/car/profile/save',
                        formDataArray = $(formElement).serializeArray();
                    const payload = formDataArray.reduce((obj, item) => {
                        obj[item.name] = item.value;
                        return obj;
                    }, {});

                    return storage.post(
                        serviceUrl,
                        JSON.stringify(payload)
                    ).done(
                        function (response) {
                            if (response.success) {
                                messageList.addSuccessMessage({message: response.message});
                                window.location.href = urlBuilder.build(response.redirect);
                            } else {
                                messageList.addErrorMessage({message: response.message});
                            }
                        }
                    ).fail(
                        function (response) {
                            messageList.addErrorMessage({message: response.responseJSON.message});
                        }
                    );
                } else {
                    return false;
                }
            }
        });
    });

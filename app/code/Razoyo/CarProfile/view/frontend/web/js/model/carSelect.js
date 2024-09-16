define([
        'ko',
        'jquery',
        'mage/url',
        'mage/storage',
        'Magento_Ui/js/model/messageList',
        'Razoyo_CarProfile/js/model/car',
        'Razoyo_CarProfile/js/select2/select2.min'
    ],
    function (ko, $, urlBuilder, storage, messageList, carModel) {
        'use strict';

        return function (config, element) {
            var serviceUrl = urlBuilder.build(config.url)
            $(element).select2({
                ajax: {
                    url: serviceUrl,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                    },
                    processResults: function (data, params) {
                        var options = data.items.map(function (item) {
                            return {
                                id: item.car_id || item.id,
                                text: `${item.make}_${item.model}_${item.year}`
                            };
                        });
                        return {
                            results: options
                        };
                    },
                    cache: true
                },
                placeholder: 'Select a car',
                allowClear: true,
                width: '100%'
            });

            // On select2:select event getCarDetails from api
            $(element).on('select2:select', function (e) {
                var data = e.params.data,
                    carId = data.car_id || data.id,
                    url = serviceUrl + carId;
                return storage.get(
                    url, false
                ).done(function (response) {
                    carModel.setData(response);
                    messageList.addSuccessMessage({message: 'Car details loaded successfully'});
                }).fail(function (response) {
                    messageList.addErrorMessage({message: response.responseJSON.message});
                });
            });
        }
    });

define([
    'ko'
], function (ko) {
    'use strict';

    return {
        id: ko.observable(''),
        car_id: ko.observable(''),
        year: ko.observable(''),
        make: ko.observable(''),
        model: ko.observable(''),
        price: ko.observable(''),
        seats: ko.observable(''),
        mpg: ko.observable(''),
        image: ko.observable(''),
        setData: function (data) {
            for (let key in data) {
                if (this.hasOwnProperty(key)) {
                    if (ko.isObservable(this[key])) {
                        this[key](data[key]);
                    }
                }
            }
        }
    };
});

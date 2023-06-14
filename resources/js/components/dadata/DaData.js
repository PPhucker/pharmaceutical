export class DaData {
    static join(arr /*, separator */) {
        let separator = arguments.length > 1 ? arguments[1] : ', ';
        return arr.filter(function(n) {
            return n;
        }).join(separator);
    }

    static showPostalCode(address) {
        return address.postal_code;
    }

    static showRegion(address) {
        return DaData.join([
            DaData.join([address.region, address.region_type], ' '),
            DaData.join([address.area, address.area_type], ' '),
        ]);
    }

    static showCity(address) {
        return DaData.join([
            DaData.join([address.settlement, address.settlement_type], ' '),
            DaData.join([address.city, address.city_type], ' '),
        ]);
    }

    static showStreet(address) {
        return DaData.join([address.street, address.street_type], ' ');
    }

    static showHouse(address) {
        return DaData.join([
            DaData.join([address.house_type, address.house], ' '),
            DaData.join([address.block_type, address.block], ' '),
        ]);
    }

    static showFlat(address) {
        return DaData.join([address.flat_type, address.flat], ' ');
    }

    static showAddress(address) {
        const region = DaData.showRegion(address);
        const city = DaData.showCity(address);
        const street = DaData.showStreet(address);
        const house = DaData.showHouse(address);
        const flat = DaData.showFlat(address);

        const result = [
            region,
            city,
            street,
            house,
            flat,
        ];

        if (region === city) {
            delete result[0];
        }

        return DaData.join(result, ', ');
    }
}

import ko from "knockout";

class Client {
    constructor(client = {}) {
        this.id = client.client_id;
        this.name = client.name;
        this.email = ko.observable(client.email).extend({
            email: true
        });
        this.phone = client.phone;
        this.mobilePhone = client.mobile_phone;
        this.notes = client.notes;
        this.city = client.city;
        this.plz = client.plz;
        this.street = client.street;
    }
}

export default Client;

class Vehicle {
    constructor(licensePlate, size) {
        this.licensePlate = licensePlate;
        this.size = size;
        this.startTime = new Date();
    }
}

class Car extends Vehicle {
    constructor(licensePlate) {
        super(licensePlate, 1);
    }
}

class Truck extends Vehicle {
    constructor(licensePlate) {
        super(licensePlate, 2);
    }
}

class Motorcycle extends Vehicle {
    constructor(licensePlate) {
        super(licensePlate, 0.5);
    }
}

class ParkingSpot {
    constructor(spotNumber, size) {
        this.spotNumber = spotNumber;
        this.size = size;
        this.isOccupied = false;
        this.vehicle = null;
    }

    assignVehicle(vehicle) {
        if (this.isOccupied || vehicle.size > this.size) return false;
        this.vehicle = vehicle;
        this.isOccupied = true;
        return true;
    }

    freeSpot() {
        this.vehicle = null;
        this.isOccupied = false;
    }
}

class ParkingLot {
    constructor() {
        this.spots = [
            new ParkingSpot(1, 1), new ParkingSpot(2, 2), new ParkingSpot(3, 1), 
            new ParkingSpot(4, 0.5), new ParkingSpot(5, 1), new ParkingSpot(6, 1)
        ];
    }

    parkVehicle(vehicle) {
        for (const spot of this.spots) {
            if (!spot.isOccupied && spot.size >= vehicle.size) {
                if (spot.assignVehicle(vehicle)) {
                    this.updateUI();
                    return;
                }
            }
        }
        alert("No suitable spot available for this vehicle.");
    }

    leaveSpot(spotNumber) {
        const spot = this.spots.find(s => s.spotNumber === spotNumber);
        if (spot) {
            spot.freeSpot();
            this.updateUI();
        }
    }

    checkFreeSpots() {
        return this.spots.filter(spot => !spot.isOccupied);
    }

    updateUI() {
        const parkingLotDiv = document.getElementById('parkingLot');
        parkingLotDiv.innerHTML = '';
        this.spots.forEach(spot => {
            const spotDiv = document.createElement('div');
            spotDiv.className = `p-4 border rounded ${spot.isOccupied ? 'bg-red-400' : 'bg-green-400'}`;
            spotDiv.innerHTML = spot.isOccupied ? `${spot.vehicle.licensePlate}` : `Spot ${spot.spotNumber}`;
            if (spot.isOccupied) {
                const leaveButton = document.createElement('button');
                leaveButton.className = 'text-white bg-blue-600 px-2 py-1 rounded ml-2';
                leaveButton.innerText = 'Leave';
                leaveButton.onclick = () => this.leaveSpot(spot.spotNumber);
                spotDiv.appendChild(leaveButton);
            }
            parkingLotDiv.appendChild(spotDiv);
        });

        const freeSpotsDiv = document.getElementById('freeSpotsList');
        freeSpotsDiv.innerHTML = `Free Spots: ${this.checkFreeSpots().map(s => s.spotNumber).join(', ')}`;
    }
}

const parkingLot = new ParkingLot();
parkingLot.updateUI();

function addVehicle() {
    const licensePlate = document.getElementById('licensePlate').value;
    const vehicleType = document.getElementById('vehicleType').value;
    
    let vehicle;
    if (vehicleType === 'car') vehicle = new Car(licensePlate);
    else if (vehicleType === 'truck') vehicle = new Truck(licensePlate);
    else if (vehicleType === 'motorcycle') vehicle = new Motorcycle(licensePlate);
    
    parkingLot.parkVehicle(vehicle);
}

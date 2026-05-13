import sys
import json
from skyfield.api import load, EarthSatellite, wgs84
from datetime import datetime

def calculate_position(line1, line2):
    try:
        # Load timescale dan data ephemeris
        ts = load.timescale()
        t = ts.now()

        # Inisialisasi Satelit dari TLE
        satellite = EarthSatellite(line1, line2, 'SAT-1', ts)

        # 1. Propagasi (TLE -> ECI)
        # 2. Transformasi (ECI -> ECEF -> Geodetik)
        geocentric = satellite.at(t)
        subpoint = wgs84.subpoint(geocentric)

        # Output Data
        result = {
            "status": "success",
            "latitude": round(subpoint.latitude.degrees, 6),
            "longitude": round(subpoint.longitude.degrees, 6),
            "altitude": round(subpoint.elevation.km, 2),
            "timestamp": datetime.now().isoformat()
        }
        return result
    except Exception as e:
        return {"status": "error", "message": str(e)}

if __name__ == "__main__":
    # Mengambil argumen TLE dari Laravel
    if len(sys.argv) > 2:
        line1 = sys.argv[1]
        line2 = sys.argv[2]
        print(json.dumps(calculate_position(line1, line2)))

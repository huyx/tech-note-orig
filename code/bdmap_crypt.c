#include <stdio.h>  
#include <math.h>  
  
const double x_pi = 3.14159265358979324 * 3000.0 / 180.0;  
  
void bd_encrypt(double gg_lat, double gg_lon, double *bd_lat, double *bd_lon)  
{  
    double x = gg_lon, y = gg_lat;  
    double z = sqrt(x * x + y * y) + 0.00002 * sin(y * x_pi);  
    double theta = atan2(y, x) + 0.000003 * cos(x * x_pi);  
    *bd_lon = z * cos(theta) + 0.0065;  
    *bd_lat = z * sin(theta) + 0.006;  
}  
  
void bd_decrypt(double bd_lat, double bd_lon, double *gg_lat, double *gg_lon)  
{  
    double x = bd_lon - 0.0065, y = bd_lat - 0.006;  
    double z = sqrt(x * x + y * y) - 0.00002 * sin(y * x_pi);  
    double theta = atan2(y, x) - 0.000003 * cos(x * x_pi);  
    *gg_lon = z * cos(theta);  
    *gg_lat = z * sin(theta);  
}

void main(void)
{
    double gg_lat = 34.12121;
    double gg_lng = 113.12121;
    double bd_lat, bd_lng;
    printf("%.6f, %.6f\n", gg_lat, gg_lng);
    bd_encrypt(gg_lat, gg_lng, &bd_lat, &bd_lng);
    printf("%.6f, %.6f\n", bd_lat, bd_lng);
    bd_decrypt(bd_lat, bd_lng, &gg_lat, &gg_lng);
    printf("%.6f, %.6f\n", gg_lat, gg_lng);
}

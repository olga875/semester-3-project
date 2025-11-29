#include <stdio.h>
#include <string.h>
#include "pico/stdlib.h"
#include "pico/cyw43_arch.h"
#include <lwip/apps/mqtt.h>
#include <lwip/ip_addr.h>
#include "config.h"

const char *PICO_WIFI_SSID = WIFI_SSID;
const char *PICO_WIFI_PASS = WIFI_PASS;
ip_addr_t BROKER_IP;
volatile bool blink_request = false;
const uint LED = 7;
const uint BUZZER = 20;
const uint ON = 1;
const uint OFF = 0;

void led_blink()
{
    gpio_init(LED);
    gpio_init(BUZZER);
    gpio_set_dir(LED, true);
    gpio_set_dir(BUZZER, true);

    gpio_put(LED, ON);
    gpio_put(BUZZER, ON);
    sleep_ms(500);
    gpio_put(LED, OFF);
    gpio_put(BUZZER, OFF);
    sleep_ms(500);
    gpio_put(LED, ON);
    gpio_put(BUZZER, ON);
    sleep_ms(500);
    gpio_put(LED, OFF);
    gpio_put(BUZZER, OFF);
    sleep_ms(500);
    gpio_put(LED, ON);
    gpio_put(BUZZER, ON);
    sleep_ms(500);
    gpio_put(LED, OFF);
    gpio_put(BUZZER, OFF);
}
mqtt_client_t *client;

void mqtt_incoming_data_cb(void *arg, const u8_t *data, u16_t len, u8_t flags)
{
    if(flags == MQTT_DATA_FLAG_LAST && len == 5 && memcmp(data, "blink", 5) == 0)
    {
        blink_request = true;
    }
}

void mqtt_connection_cb(mqtt_client_t *client, void *arg, mqtt_connection_status_t status)
{
    if (status == MQTT_CONNECT_ACCEPTED)
    {
        printf("MQTT callback successful.");
        mqtt_subscribe(client, "pico/blink", 0, NULL, NULL);
        mqtt_set_inpub_callback(client, NULL, mqtt_incoming_data_cb, NULL);
    }
    else
    {
        printf("MQTT callback failed, status = %d\n", status);
    }
}

int main()
{
    stdio_init_all();

    // Initialise the Wi-Fi chip
    if (cyw43_arch_init())
    {
        printf("Wi-Fi init failed\n");
        return -1;
    }
    cyw43_arch_enable_sta_mode();
    if (cyw43_arch_wifi_connect_timeout_ms(WIFI_SSID, WIFI_PASS, CYW43_AUTH_WPA2_AES_PSK, 30000))
    {
        printf("Failed to connect to WiFi.\n");
        return -1;
    }
    else
    {
        printf("Connected to WiFi successfully.\n");
    }
    int ipconvert = ipaddr_aton(BROKER_IP_STRING, &BROKER_IP);
    if (ipconvert == 0)
    {
        printf("Failed to parse broker IP.\n");
        return -1;
    }
    else
    {
        printf("Broker IP parsed successfully.\n");
    }

    mqtt_connect_client_info_t clinfo;
    clinfo.client_id = "clientid";
    clinfo.keep_alive = 0;
    clinfo.client_user = NULL;
    clinfo.client_pass = NULL;
    clinfo.will_topic = NULL;
    clinfo.will_msg = NULL;
    clinfo.will_retain = 0;
    clinfo.will_qos = 0;

    client = mqtt_client_new();
    err_t err = mqtt_client_connect(client, &BROKER_IP, 1883, mqtt_connection_cb, NULL, &clinfo);
    if (err != ERR_OK)
    {
        printf("Failed to connect to MQTT.\n");
        return -1;
    }
    else
    {
        printf("Connected to MQTT successfully.\n");
    }
    while (true)
    {
        if(blink_request == true)
        {
            led_blink();
            blink_request = false;
        }
        sleep_ms(100);
    }
}

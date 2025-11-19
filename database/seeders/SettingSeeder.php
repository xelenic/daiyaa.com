<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ============================================
            // GENERAL / WEBSITE SETTINGS
            // ============================================
            [
                'key' => 'site_name',
                'value' => 'Daiyaa Restaurant',
                'type' => 'text',
                'label' => 'Website Name',
                'group' => 'general',
                'order' => 1,
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Authentic Sri Lankan Cuisine in Wellawaya',
                'type' => 'text',
                'label' => 'Website Tagline',
                'group' => 'general',
                'order' => 2,
            ],
            [
                'key' => 'site_description',
                'value' => 'Experience the authentic taste of Sri Lankan cuisine at Daiyaa Restaurant, located in the heart of Wellawaya.',
                'type' => 'textarea',
                'label' => 'Website Description',
                'group' => 'general',
                'order' => 3,
            ],
            [
                'key' => 'site_logo',
                'value' => '/logo.png',
                'type' => 'image',
                'label' => 'Website Logo',
                'group' => 'general',
                'order' => 4,
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'type' => 'image',
                'label' => 'Website Favicon',
                'group' => 'general',
                'order' => 5,
            ],
            [
                'key' => 'site_footer_text',
                'value' => '© 2025 Daiyaa Restaurant. All rights reserved.',
                'type' => 'textarea',
                'label' => 'Footer Copyright Text',
                'group' => 'general',
                'order' => 6,
            ],
            [
                'key' => 'site_currency',
                'value' => 'LKR',
                'type' => 'select',
                'label' => 'Currency',
                'options' => [
                    'LKR' => 'Sri Lankan Rupee (Rs)',
                    'USD' => 'US Dollar ($)',
                    'EUR' => 'Euro (€)',
                    'GBP' => 'British Pound (£)',
                ],
                'group' => 'general',
                'order' => 7,
            ],
            [
                'key' => 'site_currency_symbol',
                'value' => 'Rs',
                'type' => 'text',
                'label' => 'Currency Symbol',
                'group' => 'general',
                'order' => 8,
            ],
            [
                'key' => 'site_language',
                'value' => 'en',
                'type' => 'select',
                'label' => 'Default Language',
                'options' => [
                    'en' => 'English',
                    'si' => 'Sinhala',
                    'ta' => 'Tamil',
                ],
                'group' => 'general',
                'order' => 9,
            ],

            // ============================================
            // CONTACT INFORMATION
            // ============================================
            [
                'key' => 'contact_phone',
                'value' => '055 727 2000',
                'type' => 'text',
                'label' => 'Primary Phone Number',
                'group' => 'contact',
                'order' => 1,
            ],
            [
                'key' => 'contact_phone_secondary',
                'value' => '076 486 2323',
                'type' => 'text',
                'label' => 'Secondary Phone Number',
                'group' => 'contact',
                'order' => 2,
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@daiyaa.com',
                'type' => 'text',
                'label' => 'Primary Email Address',
                'group' => 'contact',
                'order' => 3,
            ],
            [
                'key' => 'contact_email_support',
                'value' => 'ruwan502324@gmail.com',
                'type' => 'text',
                'label' => 'Support Email Address',
                'group' => 'contact',
                'order' => 4,
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '+94552234567',
                'type' => 'text',
                'label' => 'WhatsApp Number (with country code)',
                'group' => 'contact',
                'order' => 5,
            ],
            [
                'key' => 'contact_address',
                'value' => 'No.161, Monaragala Road, Wellawaya',
                'type' => 'textarea',
                'label' => 'Physical Address',
                'group' => 'contact',
                'order' => 6,
            ],
            [
                'key' => 'contact_city',
                'value' => 'Wellawaya',
                'type' => 'text',
                'label' => 'City',
                'group' => 'contact',
                'order' => 7,
            ],
            [
                'key' => 'contact_postal_code',
                'value' => '90200',
                'type' => 'text',
                'label' => 'Postal/Zip Code',
                'group' => 'contact',
                'order' => 8,
            ],
            [
                'key' => 'contact_country',
                'value' => 'Sri Lanka',
                'type' => 'text',
                'label' => 'Country',
                'group' => 'contact',
                'order' => 9,
            ],
            [
                'key' => 'contact_map_latitude',
                'value' => '6.7323',
                'type' => 'text',
                'label' => 'Google Maps Latitude',
                'group' => 'contact',
                'order' => 10,
            ],
            [
                'key' => 'contact_map_longitude',
                'value' => '81.0766',
                'type' => 'text',
                'label' => 'Google Maps Longitude',
                'group' => 'contact',
                'order' => 11,
            ],
            [
                'key' => 'contact_map_embed_url',
                'value' => '',
                'type' => 'textarea',
                'label' => 'Google Maps Embed URL',
                'group' => 'contact',
                'order' => 12,
            ],

            // ============================================
            // BUSINESS HOURS
            // ============================================
            [
                'key' => 'hours_open',
                'value' => '10:00 AM',
                'type' => 'text',
                'label' => 'Opening Time',
                'group' => 'hours',
                'order' => 1,
            ],
            [
                'key' => 'hours_close',
                'value' => '11:00 PM',
                'type' => 'text',
                'label' => 'Closing Time',
                'group' => 'hours',
                'order' => 2,
            ],
            [
                'key' => 'hours_days',
                'value' => 'Monday - Sunday',
                'type' => 'text',
                'label' => 'Operating Days',
                'group' => 'hours',
                'order' => 3,
            ],
            [
                'key' => 'hours_special_note',
                'value' => 'Open all public holidays',
                'type' => 'textarea',
                'label' => 'Special Hours Note',
                'group' => 'hours',
                'order' => 4,
            ],

            // ============================================
            // SOCIAL MEDIA NETWORKS
            // ============================================
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/daiyaa',
                'type' => 'text',
                'label' => 'Facebook Page URL',
                'group' => 'social',
                'order' => 1,
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/daiyaa',
                'type' => 'text',
                'label' => 'Instagram Profile URL',
                'group' => 'social',
                'order' => 2,
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/daiyaa',
                'type' => 'text',
                'label' => 'Twitter/X Profile URL',
                'group' => 'social',
                'order' => 3,
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'text',
                'label' => 'YouTube Channel URL',
                'group' => 'social',
                'order' => 4,
            ],
            [
                'key' => 'social_tiktok',
                'value' => '',
                'type' => 'text',
                'label' => 'TikTok Profile URL',
                'group' => 'social',
                'order' => 5,
            ],
            [
                'key' => 'social_linkedin',
                'value' => '',
                'type' => 'text',
                'label' => 'LinkedIn Profile URL',
                'group' => 'social',
                'order' => 6,
            ],
            [
                'key' => 'social_pinterest',
                'value' => '',
                'type' => 'text',
                'label' => 'Pinterest Profile URL',
                'group' => 'social',
                'order' => 7,
            ],
            [
                'key' => 'social_telegram',
                'value' => '',
                'type' => 'text',
                'label' => 'Telegram Channel URL',
                'group' => 'social',
                'order' => 8,
            ],
            [
                'key' => 'social_snapchat',
                'value' => '',
                'type' => 'text',
                'label' => 'Snapchat Username',
                'group' => 'social',
                'order' => 9,
            ],
            [
                'key' => 'social_tripadvisor',
                'value' => '',
                'type' => 'text',
                'label' => 'TripAdvisor URL',
                'group' => 'social',
                'order' => 10,
            ],
            [
                'key' => 'social_yelp',
                'value' => '',
                'type' => 'text',
                'label' => 'Yelp Business URL',
                'group' => 'social',
                'order' => 11,
            ],

            // ============================================
            // SEO SETTINGS
            // ============================================
            [
                'key' => 'seo_title',
                'value' => 'Daiyaa Restaurant - Authentic Sri Lankan Cuisine',
                'type' => 'text',
                'label' => 'SEO Meta Title',
                'group' => 'seo',
                'order' => 1,
            ],
            [
                'key' => 'seo_description',
                'value' => 'Experience authentic Sri Lankan cuisine at Daiyaa Restaurant in Wellawaya. Fresh ingredients, traditional recipes, and exceptional service.',
                'type' => 'textarea',
                'label' => 'SEO Meta Description',
                'group' => 'seo',
                'order' => 2,
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'sri lankan restaurant, wellawaya food, authentic cuisine, daiyaa restaurant, rice and curry',
                'type' => 'textarea',
                'label' => 'SEO Keywords (comma separated)',
                'group' => 'seo',
                'order' => 3,
            ],
            [
                'key' => 'seo_og_image',
                'value' => null,
                'type' => 'image',
                'label' => 'Social Media Share Image (Open Graph)',
                'group' => 'seo',
                'order' => 4,
            ],
            [
                'key' => 'seo_google_analytics_id',
                'value' => '',
                'type' => 'text',
                'label' => 'Google Analytics ID (GA4)',
                'group' => 'seo',
                'order' => 5,
            ],
            [
                'key' => 'seo_google_tag_manager_id',
                'value' => '',
                'type' => 'text',
                'label' => 'Google Tag Manager ID',
                'group' => 'seo',
                'order' => 6,
            ],
            [
                'key' => 'seo_facebook_pixel_id',
                'value' => '',
                'type' => 'text',
                'label' => 'Facebook Pixel ID',
                'group' => 'seo',
                'order' => 7,
            ],

            // ============================================
            // DELIVERY & PAYMENT SETTINGS
            // ============================================
            [
                'key' => 'delivery_minimum_order',
                'value' => '500',
                'type' => 'text',
                'label' => 'Minimum Order Amount',
                'group' => 'delivery',
                'order' => 1,
            ],
            [
                'key' => 'delivery_fee',
                'value' => '150',
                'type' => 'text',
                'label' => 'Standard Delivery Fee',
                'group' => 'delivery',
                'order' => 2,
            ],
            [
                'key' => 'delivery_free_above',
                'value' => '2000',
                'type' => 'text',
                'label' => 'Free Delivery Above Amount',
                'group' => 'delivery',
                'order' => 3,
            ],
            [
                'key' => 'delivery_radius',
                'value' => '10',
                'type' => 'text',
                'label' => 'Delivery Radius (km)',
                'group' => 'delivery',
                'order' => 4,
            ],
            [
                'key' => 'delivery_estimated_time',
                'value' => '30-45 minutes',
                'type' => 'text',
                'label' => 'Estimated Delivery Time',
                'group' => 'delivery',
                'order' => 5,
            ],
            [
                'key' => 'payment_cash_on_delivery',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Accept Cash on Delivery',
                'group' => 'delivery',
                'order' => 6,
            ],
            [
                'key' => 'payment_online_enabled',
                'value' => '0',
                'type' => 'toggle',
                'label' => 'Accept Online Payments',
                'group' => 'delivery',
                'order' => 7,
            ],

            // ============================================
            // FEATURE TOGGLES
            // ============================================
            [
                'key' => 'feature_online_ordering',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Enable Online Ordering',
                'group' => 'features',
                'order' => 1,
            ],
            [
                'key' => 'feature_promotions',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Show Promotion Popup',
                'group' => 'features',
                'order' => 2,
            ],
            [
                'key' => 'feature_table_reservation',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Enable Table Reservations',
                'group' => 'features',
                'order' => 3,
            ],
            [
                'key' => 'feature_customer_reviews',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Show Customer Reviews',
                'group' => 'features',
                'order' => 4,
            ],
            [
                'key' => 'feature_newsletter',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Enable Newsletter Signup',
                'group' => 'features',
                'order' => 5,
            ],
            [
                'key' => 'feature_loyalty_program',
                'value' => '0',
                'type' => 'toggle',
                'label' => 'Enable Loyalty Program',
                'group' => 'features',
                'order' => 6,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'toggle',
                'label' => 'Maintenance Mode',
                'group' => 'features',
                'order' => 7,
            ],

            // ============================================
            // EMAIL SETTINGS
            // ============================================
            [
                'key' => 'email_from_name',
                'value' => 'Daiyaa Restaurant',
                'type' => 'text',
                'label' => 'Email From Name',
                'group' => 'email',
                'order' => 1,
            ],
            [
                'key' => 'email_from_address',
                'value' => 'noreply@daiyaa.lk',
                'type' => 'text',
                'label' => 'Email From Address',
                'group' => 'email',
                'order' => 2,
            ],
            [
                'key' => 'email_order_confirmation',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Send Order Confirmation Email',
                'group' => 'email',
                'order' => 3,
            ],
            [
                'key' => 'email_admin_notifications',
                'value' => '1',
                'type' => 'toggle',
                'label' => 'Send Admin Order Notifications',
                'group' => 'email',
                'order' => 4,
            ],
            [
                'key' => 'email_admin_address',
                'value' => 'admin@daiyaa.lk',
                'type' => 'text',
                'label' => 'Admin Notification Email',
                'group' => 'email',
                'order' => 5,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}

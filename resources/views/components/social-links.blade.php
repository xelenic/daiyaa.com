@props(['class' => 'social-links', 'iconSize' => '1.5rem'])

<div class="{{ $class }}">
    @if(setting('social_facebook'))
        <a href="{{ setting('social_facebook') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Facebook" aria-label="Visit our Facebook page">
            <i class="bi bi-facebook" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_instagram'))
        <a href="{{ setting('social_instagram') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Instagram" aria-label="Visit our Instagram profile">
            <i class="bi bi-instagram" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_twitter'))
        <a href="{{ setting('social_twitter') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Twitter/X" aria-label="Visit our Twitter profile">
            <i class="bi bi-twitter-x" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_youtube'))
        <a href="{{ setting('social_youtube') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="YouTube" aria-label="Visit our YouTube channel">
            <i class="bi bi-youtube" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_tiktok'))
        <a href="{{ setting('social_tiktok') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="TikTok" aria-label="Visit our TikTok profile">
            <i class="bi bi-tiktok" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_linkedin'))
        <a href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="LinkedIn" aria-label="Visit our LinkedIn profile">
            <i class="bi bi-linkedin" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_pinterest'))
        <a href="{{ setting('social_pinterest') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Pinterest" aria-label="Visit our Pinterest profile">
            <i class="bi bi-pinterest" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_telegram'))
        <a href="{{ setting('social_telegram') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Telegram" aria-label="Join our Telegram channel">
            <i class="bi bi-telegram" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_snapchat'))
        <a href="https://www.snapchat.com/add/{{ setting('social_snapchat') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Snapchat" aria-label="Add us on Snapchat">
            <i class="bi bi-snapchat" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_tripadvisor'))
        <a href="{{ setting('social_tripadvisor') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="TripAdvisor" aria-label="Review us on TripAdvisor">
            <i class="bi bi-star-fill" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif

    @if(setting('social_yelp'))
        <a href="{{ setting('social_yelp') }}" target="_blank" rel="noopener noreferrer" 
           class="social-link" title="Yelp" aria-label="Review us on Yelp">
            <i class="bi bi-yelp" style="font-size: {{ $iconSize }};"></i>
        </a>
    @endif
</div>

<style>
    .social-links {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .social-link {
        color: inherit;
        transition: all 0.3s ease;
        opacity: 0.8;
    }

    .social-link:hover {
        opacity: 1;
        transform: translateY(-2px);
        color: var(--primary-gold, #d4af37);
    }

    .social-link i {
        display: block;
    }
</style>



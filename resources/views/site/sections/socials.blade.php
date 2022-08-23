{{-- accepts 'classes' for first row tag. and 'size' which can be 'lg' only --}}

{{-- $facebook  --}}
{{-- $twitter   --}}
{{-- $instagram --}}
{{-- $snapchat  --}}
{{-- $youtube   --}}
{{-- $whatsapp  --}}

<div class="row {{ $classes ?? '' }}">
    @if($facebook)
        <a href="{{ $facebook }}" target="_blank" class="social-icon mx-1">
            <svg class="material-icons {{ !isset($icon_classes) ?: $icon_classes }}" viewBox="0 0 24 24">
                <path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z"></path>
            </svg>
        </a>
    @endif
    @if($twitter)
        <a href="{{ $twitter }}" target="_blank" class="social-icon mx-1">
            <svg class="material-icons {{ !isset($icon_classes) ?: $icon_classes }}" viewBox="0 0 24 24">
                <path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M17.71,9.33C18.19,8.93 18.75,8.45 19,7.92C18.59,8.13 18.1,8.26 17.56,8.33C18.06,7.97 18.47,7.5 18.68,6.86C18.16,7.14 17.63,7.38 16.97,7.5C15.42,5.63 11.71,7.15 12.37,9.95C9.76,9.79 8.17,8.61 6.85,7.16C6.1,8.38 6.75,10.23 7.64,10.74C7.18,10.71 6.83,10.57 6.5,10.41C6.54,11.95 7.39,12.69 8.58,13.09C8.22,13.16 7.82,13.18 7.44,13.12C7.81,14.19 8.58,14.86 9.9,15C9,15.76 7.34,16.29 6,16.08C7.15,16.81 8.46,17.39 10.28,17.31C14.69,17.11 17.64,13.95 17.71,9.33Z"></path>
            </svg>
        </a>
    @endif
    @if($instagram)
        <a href="{{$instagram}}" target="_blank" class="social-icon mx-1">
            <svg class="material-icons {{ !isset($icon_classes) ?: $icon_classes }}" viewBox="0 0 24 24">
                <path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"></path>
            </svg>
        </a>
    @endif
    @if($snapchat)
        <a href="{{$snapchat}}" target="_blank" class="social-icon mx-1">
            <svg class="material-icons {{ !isset($icon_classes) ?: $icon_classes }}" viewBox="0 0 24 24">
                <path fill="currentColor" d="M21.93 16.56C21.79 16.18 21.5 16 21.22 15.81C21.17 15.78 21.11 15.75 21.07 15.73C21 15.68 20.89 15.64 20.8 15.59C19.86 15.09 19.12 14.46 18.61 13.72C18.47 13.5 18.35 13.29 18.24 13.06C18.2 12.93 18.2 12.86 18.23 12.8C18.26 12.75 18.3 12.7 18.35 12.67C18.5 12.56 18.68 12.46 18.79 12.38C19 12.25 19.15 12.15 19.25 12.08C19.64 11.81 19.91 11.5 20.08 11.2C20.32 10.75 20.35 10.22 20.16 9.75C19.91 9.08 19.27 8.66 18.5 8.66C18.34 8.66 18.18 8.68 18 8.71C18 8.72 17.94 8.73 17.9 8.74C17.9 8.28 17.89 7.8 17.85 7.32C17.71 5.64 17.12 4.76 16.5 4.06C16.11 3.62 15.65 3.24 15.14 2.95C14.21 2.42 13.15 2.15 12 2.15S9.8 2.42 8.87 2.95C8.35 3.24 7.89 3.62 7.5 4.06C6.88 4.76 6.3 5.64 6.15 7.32C6.11 7.8 6.1 8.28 6.11 8.74C6.06 8.73 6 8.72 6 8.71C5.82 8.68 5.66 8.66 5.5 8.66C4.73 8.66 4.09 9.08 3.84 9.75C3.65 10.22 3.68 10.75 3.92 11.2C4.09 11.5 4.36 11.81 4.75 12.08C4.85 12.15 5 12.25 5.21 12.39L5.63 12.66C5.69 12.7 5.73 12.75 5.77 12.8C5.8 12.87 5.8 12.94 5.75 13.07C5.65 13.3 5.53 13.5 5.39 13.72C4.89 14.45 4.18 15.07 3.27 15.56C2.78 15.82 2.28 16 2.07 16.56C1.91 17 2 17.5 2.42 17.91C2.57 18.06 2.74 18.19 2.93 18.29C3.33 18.5 3.75 18.68 4.18 18.79C4.27 18.82 4.36 18.85 4.43 18.91C4.58 19.03 4.56 19.23 4.76 19.5C4.86 19.66 5 19.79 5.13 19.89C5.54 20.18 6 20.19 6.5 20.21C6.94 20.23 7.44 20.25 8 20.44C8.26 20.5 8.5 20.67 8.79 20.85C9.5 21.27 10.42 21.85 12 21.85C13.57 21.85 14.5 21.27 15.22 20.84C15.5 20.67 15.75 20.5 16 20.44C16.55 20.25 17.06 20.23 17.5 20.21C18 20.2 18.46 20.18 18.87 19.89C19.04 19.77 19.18 19.61 19.29 19.43C19.43 19.19 19.43 19 19.56 18.91C19.63 18.86 19.71 18.82 19.8 18.8C20.24 18.68 20.66 18.5 21.06 18.29C21.27 18.18 21.45 18.04 21.6 17.87L21.61 17.87C22 17.46 22.08 17 21.93 16.56M20.53 17.31C19.67 17.78 19.1 17.73 18.66 18C18.5 18.12 18.45 18.28 18.42 18.44C18.41 18.5 18.4 18.58 18.39 18.64C18.37 18.78 18.34 18.9 18.24 18.97C17.9 19.2 16.91 18.95 15.63 19.37C14.57 19.72 13.9 20.73 12 20.73C10.1 20.73 9.45 19.73 8.37 19.37C7.1 18.95 6.1 19.2 5.77 18.97C5.5 18.78 5.72 18.26 5.34 18C4.9 17.73 4.33 17.78 3.5 17.31C3.19 17.15 3.14 17 3.18 16.93C3.22 16.84 3.34 16.77 3.42 16.73C5.07 15.94 6 14.91 6.47 14.1C6.91 13.38 7 12.83 7.03 12.75C7.06 12.54 7.09 12.38 6.86 12.17C6.64 11.96 5.66 11.36 5.39 11.17C4.93 10.85 4.74 10.54 4.88 10.15L4.88 10.15V10.15C5 9.88 5.23 9.78 5.5 9.78C5.58 9.78 5.66 9.79 5.74 9.81C6.24 9.91 6.72 10.16 7 10.23C7.03 10.24 7.06 10.24 7.1 10.24C7.19 10.24 7.24 10.21 7.27 10.15C7.28 10.11 7.29 10.06 7.29 10C7.25 9.46 7.18 8.41 7.26 7.42C7.3 7 7.37 6.64 7.46 6.33C7.66 5.65 8 5.2 8.34 4.79C8.59 4.5 9.75 3.27 12 3.27C13.85 3.27 14.96 4.11 15.44 4.56C15.54 4.66 15.62 4.74 15.66 4.79C16.04 5.23 16.38 5.71 16.58 6.47C16.65 6.74 16.71 7.06 16.74 7.42C16.82 8.4 16.75 9.46 16.71 10C16.71 10.04 16.71 10.08 16.72 10.11C16.73 10.2 16.79 10.24 16.9 10.24C16.94 10.24 16.97 10.24 17 10.23C17.28 10.16 17.76 9.91 18.26 9.8C18.34 9.79 18.42 9.78 18.5 9.78C18.75 9.78 19 9.87 19.1 10.1L19.11 10.14L19.12 10.14L19.12 10.15C19.27 10.53 19.07 10.85 18.62 11.16C18.35 11.35 17.36 11.96 17.14 12.16C16.91 12.38 16.94 12.54 16.97 12.75C17 12.85 17.18 13.8 18.08 14.86C18.63 15.5 19.42 16.17 20.58 16.73C20.65 16.76 20.74 16.81 20.79 16.87C20.82 16.92 20.84 16.96 20.83 17C20.82 17.1 20.73 17.2 20.53 17.31Z" />
            </svg>
        </a>
    @endif
    @if($youtube)
        <a href="{{$youtube}}" target="_blank" class="social-icon mx-1">
            <svg class="material-icons {{ !isset($icon_classes) ?: $icon_classes }}" viewBox="0 0 24 24">
                <path fill="currentColor" d="M10,15L15.19,12L10,9V15M21.56,7.17C21.69,7.64 21.78,8.27 21.84,9.07C21.91,9.87 21.94,10.56 21.94,11.16L22,12C22,14.19 21.84,15.8 21.56,16.83C21.31,17.73 20.73,18.31 19.83,18.56C19.36,18.69 18.5,18.78 17.18,18.84C15.88,18.91 14.69,18.94 13.59,18.94L12,19C7.81,19 5.2,18.84 4.17,18.56C3.27,18.31 2.69,17.73 2.44,16.83C2.31,16.36 2.22,15.73 2.16,14.93C2.09,14.13 2.06,13.44 2.06,12.84L2,12C2,9.81 2.16,8.2 2.44,7.17C2.69,6.27 3.27,5.69 4.17,5.44C4.64,5.31 5.5,5.22 6.82,5.16C8.12,5.09 9.31,5.06 10.41,5.06L12,5C16.19,5 18.8,5.16 19.83,5.44C20.73,5.69 21.31,6.27 21.56,7.17Z" />
            </svg>
        </a>
    @endif
    @if($whatsapp)
        <a href="https://api.whatsapp.com/send?phone={{$whatsapp}}&text=Hello,I need your help." target="blank" class="social-icon mx-1">
            <svg class="material-icons {{ !isset($icon_classes) ?: $icon_classes }}" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z"></path>
            </svg>
        </a>
    @endif
</div>

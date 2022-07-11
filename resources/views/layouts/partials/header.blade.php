<header class="d-flex align-items-center justify-content-between">
    <div class="cursor-pointer menuicn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 6H21V8H3V6ZM3 11H21V13H3V11ZM3 16H21V18H3V16Z" fill="url(#paint0_linear_1622_4657)"/>
            <defs>
            <linearGradient id="paint0_linear_1622_4657" x1="12" y1="6" x2="12" y2="18" gradientUnits="userSpaceOnUse">
            <stop stop-color="#3F189F"/>
            <stop offset="1" stop-color="#4C26AA"/>
            </linearGradient>
            </defs>
        </svg>
    </div>
    <ul class="p-0 m-0">
        <li class="dropdown middleContent p-0 userMenu">
            <a href="javascript:;" data-bs-toggle="dropdown">
                <svg width="30" height="30" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1622_4660)">
                    <path d="M8.00298 0.000347708C6.38264 0.000196848 4.80046 0.492015 3.46558 1.4107C2.1307 2.32934 1.10627 3.6315 0.527705 5.14505C-0.0510175 6.6586 -0.156496 8.31211 0.224911 9.88676C0.606461 11.4615 1.45705 12.8835 2.66417 13.9642C2.86271 14.1429 3.07075 14.3109 3.28727 14.4671C4.6561 15.4647 6.30633 16.0021 8.00001 16.0021C9.69381 16.0021 11.3439 15.4647 12.7128 14.4671C12.9294 14.3108 13.1373 14.1429 13.3357 13.9642C14.5425 12.8836 15.393 11.4623 15.7747 9.88792C16.1564 8.31373 16.0513 6.66064 15.4734 5.14737C14.8954 3.63397 13.8719 2.33185 12.538 1.41274C11.204 0.493637 9.62264 0.00104281 8.00257 0L8.00298 0.000347708ZM8.00298 2.85827V2.85843C8.60947 2.85843 9.19094 3.09922 9.61969 3.52799C10.0485 3.95678 10.2894 4.53836 10.2894 5.1447C10.2894 5.75104 10.0485 6.33265 9.61969 6.76141C9.1909 7.1902 8.60947 7.43112 8.00298 7.43112C7.39664 7.43112 6.81502 7.19018 6.38627 6.76141C5.95748 6.33262 5.71671 5.75104 5.71671 5.1447C5.71671 4.53836 5.9575 3.95674 6.38627 3.52799C6.81506 3.0992 7.39664 2.85843 8.00298 2.85843V2.85827ZM8.00298 14.2902C6.12723 14.2895 4.34966 13.4509 3.15583 12.0039C3.62683 10.6503 4.64114 9.55472 5.95447 8.98083C7.2678 8.40693 8.76095 8.40693 10.074 8.98083C11.3873 9.55472 12.4016 10.6504 12.8728 12.0039C11.674 13.4571 9.88661 14.2963 8.00283 14.2902H8.00298Z" fill="url(#paint0_linear_1622_4660)"/>
                    </g>
                    <defs>
                    <linearGradient id="paint0_linear_1622_4660" x1="8" y1="0" x2="8" y2="16.0021" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#3F189F"/>
                    <stop offset="1" stop-color="#4C26AA"/>
                    </linearGradient>
                    <clipPath id="clip0_1622_4660">
                    <rect width="16" height="16" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </a>
            <ul class="dropdown-menu notificationBody settingWrpr cards filterDropdownBx p-0 m-0">
                <div class="cardsBody settingWrpr px-0 py-1">
                    <li class="m-0 w-100">
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                        <a href="javascript:;"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <h4 class="f-16 mb-0 f-700 c-19">
                                <svg class="me-2 position-relative bottom-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M9 14H2L2 2H9" stroke="#191919" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7 8H15" stroke="#191919" stroke-width="1.75" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M12 11L15 8L12 5" stroke="#191919" stroke-width="1.75" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Logout
                            </h4>
                        </a>
                    </li>
                </div>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <svg width="30" height="30" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.36982 0.154755C6.89677 0.0575024 7.44287 0 7.99994 0C8.55717 0 9.10305 0.0575024 9.63022 0.154755L10.1085 1.8393C11.0382 2.12334 11.8802 2.59154 12.5886 3.19641L14.3697 2.7441C14.7224 3.12715 15.0479 3.54363 15.3265 4.00005C15.6051 4.45631 15.8256 4.93047 16 5.41074L14.6972 6.64281C14.796 7.08097 14.8482 7.53393 14.8482 7.99992C14.8482 8.46607 14.796 8.91899 14.6972 9.35703L16 10.5893C15.8255 11.0695 15.6051 11.5437 15.3265 11.9999C15.0479 12.4562 14.7224 12.8729 14.3697 13.2559L12.5886 12.8036C11.8802 13.4085 11.0382 13.8766 10.1085 14.1607L9.63022 15.8452C9.1031 15.9425 8.55717 16 7.99994 16C7.44287 16 6.89682 15.9425 6.36982 15.8452L5.89135 14.1607C4.9618 13.8767 4.11982 13.4085 3.41143 12.8036L1.63012 13.2559C1.27758 12.8728 0.95196 12.4562 0.673516 11.9999C0.394906 11.5437 0.174444 11.0695 0 10.5893L1.30284 9.35703C1.20399 8.91903 1.15182 8.46607 1.15182 7.99992C1.15182 7.53393 1.20399 7.08101 1.30284 6.64281L0 5.41074C0.174461 4.93047 0.394906 4.45631 0.673516 4.00005C0.951965 3.54363 1.27757 3.12713 1.63012 2.7441L3.41143 3.19641C4.11986 2.59154 4.96184 2.12336 5.89135 1.8393L6.36982 0.154755ZM8 11C9.65685 11 11 9.65685 11 8C11 6.34315 9.65685 5 8 5C6.34315 5 5 6.34315 5 8C5 9.65685 6.34315 11 8 11Z" fill="url(#paint0_linear_1622_4662)"/>
                    <defs>
                    <linearGradient id="paint0_linear_1622_4662" x1="8" y1="0" x2="8" y2="16" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#3F189F"/>
                    <stop offset="1" stop-color="#4C26AA"/>
                    </linearGradient>
                    </defs>
                </svg>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="position-relative">
                <svg width="30" height="30" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.67271 2.41047C4.41402 2.99139 2.7454 5.0408 2.7454 7.48163V10.9722C2.7454 11.294 2.48409 11.5546 2.16424 11.5546C1.52115 11.5546 1 12.0769 1 12.7183C1 13.3609 1.5219 13.8818 2.16639 13.8818H13.7971C14.4413 13.8818 14.9635 13.3597 14.9635 12.7183C14.9635 12.0755 14.4399 11.5546 13.7992 11.5546C13.4782 11.5546 13.2181 11.2959 13.2181 10.9722V7.48163C13.2181 5.04178 11.5497 2.99164 9.29077 2.41047V1.80939C9.29077 1.08448 8.70456 0.5 7.98162 0.5C7.26009 0.5 6.67266 1.0862 6.67266 1.80939L6.67271 2.41047ZM5.94541 14.4638H10.0181C10.0181 15.5885 9.10629 16.5 7.98167 16.5C6.85705 16.5 5.94547 15.5884 5.94547 14.4638H5.94541Z" fill="url(#paint0_linear_1622_4667)"/>
                    <defs>
                    <linearGradient id="paint0_linear_1622_4667" x1="7.98174" y1="0.5" x2="7.98174" y2="16.5" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#3F189F"/>
                    <stop offset="1" stop-color="#4C26AA"/>
                    </linearGradient>
                    </defs>
                </svg>
            </a>
            <span class="position-absolute justify-content-center align-items-center text-white badges f-10 f-700 d-flex">11</span>
        </li>
    </ul>
</header>

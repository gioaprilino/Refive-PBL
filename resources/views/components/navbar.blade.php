 <nav class="flex flex-wrap items-center justify-between bg-white p-[20px_30px] rounded-[20px] gap-y-3">
            <div class="flex items-center gap-3">
                <div class="flex shrink-0 h-[43px] overflow-hidden">
                    <img src="{{asset('assets/logo/F3.svg')}}" class="object-contain w-full h-full" alt="logo">
                </div>
                <div class="flex flex-col">
                  <p id="CompanyName" class="font-extrabold text-xl leading-[30px]">TRI VIRYA NUSANTARA</p>
                  <p id="CompanyTagline" class="text-sm text-cp-light-grey"></p>
                </div>
            </div>
            <ul class="flex flex-wrap items-center gap-[30px]">
              <li class="{{ request()->routeIs('front.index') ? 'text-cp-dark-blue' : '' }} font-semibold hover:text-cp-dark-blue transition-all duration-300">
                <a href="{{ route('front.index') }}">Home</a>
              </li>
              <li class="{{ request()->routeIs('front.products') ? 'text-cp-dark-blue' : '' }} font-semibold hover:text-cp-dark-blue transition-all duration-300">
                <a href="{{ route('front.products') }}">Products</a>
              </li>
              <li class="{{ request()->routeIs('front.team') ? 'text-cp-dark-blue' : '' }} font-semibold hover:text-cp-dark-blue transition-all duration-300">
                <a href="{{ route('front.team') }}">Company</a>
              </li>
              <li class="{{ request()->routeIs('front.blog') ? 'text-cp-dark-blue' : '' }} font-semibold hover:text-cp-dark-blue transition-all duration-300">
                <a href="{{ route('front.blog') }}">Blog</a>
              </li>
              <li class="{{ request()->routeIs('front.about') ? 'text-cp-dark-blue' : '' }} font-semibold hover:text-cp-dark-blue transition-all duration-300">
                <a href="{{ route('front.about') }}">About</a>
              </li>
            </ul>
            <a href="" class="bg-cp-dark-blue p-[14px_20px] w-fit rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Get a Quote</a>
        </nav>.
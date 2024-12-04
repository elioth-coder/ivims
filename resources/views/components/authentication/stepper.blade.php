<ol class="items-center space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse mx-auto block">
    <li class="flex items-center text-violet-700 space-x-2.5 rtl:space-x-reverse">
        <span
            class="flex items-center justify-center w-8 h-8 border bg-violet-700 text-white rounded-full shrink-0">
            1
        </span>
        <span>
            <h3 class="font-medium leading-tight">Policy Holder</h3>
            <p class="text-sm">Personal details of policy owner</p>
        </span>
    </li>
    <li x-bind:class="(step>=2) ? 'text-violet-700' : 'text-gray-500'" class="flex items-center space-x-2.5 rtl:space-x-reverse">
        <span x-bind:class="(step>=2) ? 'bg-violet-700 text-white' : 'bg-gray-300'"
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0">
            2
        </span>
        <span>
            <h3 class="font-medium leading-tight">Vehicle Details</h3>
            <p class="text-sm">Provide information about the vehicle</p>
        </span>
    </li>
    <li x-bind:class="(step==3) ? 'text-violet-700' : 'text-gray-500'" class="flex items-center space-x-2.5 rtl:space-x-reverse">
        <span x-bind:class="(step==3) ? 'bg-violet-700 text-white' : 'bg-gray-300'"
            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0">
            3
        </span>
        <span>
            <h3 class="font-medium leading-tight">Policy Details</h3>
            <p class="text-sm">Specify the coverage of the insurance policy</p>
        </span>
    </li>
</ol>

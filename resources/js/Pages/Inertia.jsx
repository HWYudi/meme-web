import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/inertia-react";
import dateFormat, { masks } from "dateformat";
import moment from "moment";

export default function home({ posts, user }) {
    const [Title, setTitle] = useState("");
    const [Body, setBody] = useState(null);
    const [disabled, setdisabled] = useState(false);
    const [loading, setloading] = useState(false);

    const { flash } = usePage().props;
    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = {
            title: Title,
            body: Body,
        };
        Inertia.post("/", formData, {
            onProgress: () => setloading(true),
            onFinish: () => setloading(false),
        });
    };

    const handlelike = (id) => {
        Inertia.post(
            "/posts/" + id + "/like",
            {},
            {
                onProgress: () => setdisabled(true),
                onStart: () => setdisabled(true),
                onFinish: () => setdisabled(false),
                preserveScroll: true,
            }
        );
    };

    const handleunlike = (id) => {
        Inertia.delete("/posts/" + id + "/unlike", {
            onProgress: () => setdisabled(true),
            onStart: () => setdisabled(true),
            onFinish: () => setdisabled(false),
            preserveScroll: true,
        });
    };

    console.log(posts);
    console.log(flash.message);
    return (
        <div className="px-2 lg:px-10 w-full lg:w-2/3">
            {flash.message && (
                <div class="fixed top-0 right-0 p-3">{flash.message}</div>
            )}
            <div className="popup fixed z-40 inset-0 flex hidden items-center justify-center bg-black bg-opacity-80">
                <div className="bg-black rounded-lg p-2 px-5 w-full max-w-md ">
                    <div
                        className="p-4 absolute top-0 right-0 cursor-pointer"
                        onClick={togglePopup}
                    >
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M13.41 12L19.71 5.71C19.8983 5.5217 20.0041 5.2663 20.0041 5C20.0041 4.7337 19.8983 4.4783 19.71 4.29C19.5217 4.1017 19.2663 3.99591 19 3.99591C18.7337 3.99591 18.4783 4.1017 18.29 4.29L12 10.59L5.71 4.29C5.5217 4.1017 5.2663 3.99591 5 3.99591C4.7337 3.99591 4.4783 4.1017 4.29 4.29C4.1017 4.4783 3.99591 4.7337 3.99591 5C3.99591 5.2663 4.1017 5.5217 4.29 5.71L10.59 12L4.29 18.29C4.19627 18.383 4.12188 18.4936 4.07111 18.6154C4.02034 18.7373 3.9942 18.868 3.9942 19C3.9942 19.132 4.02034 19.2627 4.07111 19.3846C4.12188 19.5064 4.19627 19.617 4.29 19.71C4.38296 19.8037 4.49356 19.8781 4.61542 19.9289C4.73728 19.9797 4.86799 20.0058 5 20.0058C5.13201 20.0058 5.26272 19.9797 5.38458 19.9289C5.50644 19.8781 5.61704 19.8037 5.71 19.71L12 13.41L18.29 19.71C18.383 19.8037 18.4936 19.8781 18.6154 19.9289C18.7373 19.9797 18.868 20.0058 19 20.0058C19.132 20.0058 19.2627 19.9797 19.3846 19.9289C19.5064 19.8781 19.617 19.8037 19.71 19.71C19.8037 19.617 19.8781 19.5064 19.9289 19.3846C19.9797 19.2627 20.0058 19.132 20.0058 19C20.0058 18.868 19.9797 18.7373 19.9289 18.6154C19.8781 18.4936 19.8037 18.383 19.71 18.29L13.41 12Z"
                                fill="white"
                            />
                        </svg>
                    </div>
                    {loading ? (
                        <div className="flex items-center justify-center">
                            <span class="loader"></span>
                        </div>
                    ) : (
                        <form
                            onSubmit={handleSubmit}
                            className="space-y-4"
                            encType="multipart/form-data"
                        >
                            <div className="flex">
                                {user && (
                                    <img
                                        src={"storage/" + user.image}
                                        alt=""
                                        className="w-12 h-12 object-cover rounded-full"
                                    />
                                )}
                                <input
                                    type="text"
                                    name="title"
                                    placeholder="What You Want To Post?"
                                    value={Title}
                                    onChange={(e) => setTitle(e.target.value)}
                                    className="text-white w-full px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 bg-transparent"
                                />
                            </div>
                            <div>
                                <input
                                    id="body"
                                    name="body"
                                    type="file"
                                    onChange={(e) => setBody(e.target.files[0])}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                />
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    className="w-full px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition-colors duration-300 ease-in-out"
                                >
                                    Submit
                                </button>
                            </div>
                        </form>
                    )}
                </div>
            </div>

            {posts.map((post) => (
                <div
                    key={post.id}
                    className="flex py-4 border-b border-white border-opacity-20 gap-2 relative"
                >
                    <Link
                        href={`/profile/${post.user.name}`}
                        className="w-12 flex justify-center"
                    >
                        <img
                            src={"storage/" + post.user.image}
                            alt=""
                            className="w-10 h-10 object-cover rounded-full"
                        />
                    </Link>
                    <div className="w-full">
                        <div className="flex justify-between">
                            <div className="mb-4">
                                <div className="flex items-center gap-2 text-white text-opacity-50">
                                    <p className="text-base">
                                        {post.user.name}
                                    </p>
                                    <svg
                                        width="4"
                                        height="4"
                                        viewBox="0 0 4 4"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <circle
                                            cx="2"
                                            cy="2"
                                            r="2"
                                            fill="white"
                                            fill-opacity="0.5"
                                        />
                                    </svg>

                                    <p className="text-sm">
                                        {moment.utc(post.created_at).fromNow()}
                                    </p>
                                </div>
                                <p className="text-md whitespace-normal break-words break-all">{post.title}</p>
                            </div>
                            <div>
                                <button
                                    className="flex items-center justify-center right-0 w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-10 cursor-pointer"
                                    onClick={() => dropdown(post.id)}
                                >
                                    <svg
                                        width="18"
                                        height="18"
                                        viewBox="0 0 68 17"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            clipRule="evenodd"
                                            d="M8.94595 16.9279C13.5384 16.9279 17.2613 13.205 17.2613 8.61263C17.2613 4.0202 13.5384 0.29731 8.94595 0.29731C4.35352 0.29731 0.63063 4.0202 0.63063 8.61263C0.63063 13.205 4.35352 16.9279 8.94595 16.9279ZM42.2072 8.61263C42.2072 13.205 38.4843 16.9279 33.8919 16.9279C29.2995 16.9279 25.5766 13.205 25.5766 8.61263C25.5766 4.0202 29.2995 0.29731 33.8919 0.29731C38.4843 0.29731 42.2072 4.0202 42.2072 8.61263ZM67.1532 8.61263C67.1532 13.205 63.4303 16.9279 58.8378 16.9279C54.2454 16.9279 50.5225 13.205 50.5225 8.61263C50.5225 4.0202 54.2454 0.29731 58.8378 0.29731C63.4303 0.29731 67.1532 4.0202 67.1532 8.61263Z"
                                            fill="white"
                                        />
                                    </svg>
                                </button>
                                <div
                                    className="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden hidden"
                                    id={`dropdown-${post.id}`}
                                >
                                    <button
                                        href="#"
                                        className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M19 2H6.27001C5.5682 2.00023 4.88868 2.24651 4.34969 2.69598C3.81069 3.14544 3.44633 3.76965 3.32001 4.46L2.05001 11.46C1.97088 11.8924 1.98775 12.337 2.09944 12.7622C2.21113 13.1874 2.41491 13.5828 2.69634 13.9206C2.97778 14.2583 3.33 14.53 3.72809 14.7166C4.12617 14.9031 4.56039 14.9999 5.00001 15H9.56001L9.00001 16.43C8.76707 17.0561 8.6895 17.7294 8.77394 18.3921C8.85838 19.0548 9.10232 19.6871 9.48482 20.2348C9.86732 20.7825 10.377 21.2292 10.9701 21.5367C11.5632 21.8441 12.222 22.0031 12.89 22C13.0824 21.9996 13.2705 21.9437 13.4319 21.8391C13.5933 21.7344 13.7211 21.5854 13.8 21.41L16.65 15H19C19.7957 15 20.5587 14.6839 21.1213 14.1213C21.6839 13.5587 22 12.7956 22 12V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7957 2 19 2ZM15 13.79L12.28 19.91C12.0017 19.8258 11.7436 19.6855 11.5215 19.4978C11.2995 19.31 11.1183 19.0788 10.989 18.8183C10.8597 18.5579 10.7851 18.2737 10.7698 17.9834C10.7545 17.693 10.7988 17.4026 10.9 17.13L11.43 15.7C11.5429 15.3977 11.5811 15.0727 11.5411 14.7525C11.5012 14.4323 11.3844 14.1265 11.2007 13.8613C11.017 13.596 10.7718 13.3791 10.4861 13.2292C10.2004 13.0792 9.88267 13.0006 9.56001 13H5.00001C4.8531 13.0002 4.70794 12.9681 4.57485 12.9059C4.44177 12.8437 4.32403 12.7529 4.23001 12.64C4.13367 12.5287 4.06311 12.3975 4.02335 12.2557C3.98359 12.114 3.97562 11.9652 4.00001 11.82L5.27001 4.82C5.3126 4.58704 5.43649 4.37676 5.61962 4.2266C5.80274 4.07644 6.03322 3.99614 6.27001 4H15V13.79ZM20 12C20 12.2652 19.8947 12.5196 19.7071 12.7071C19.5196 12.8946 19.2652 13 19 13H17V4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8947 4.48043 20 4.73478 20 5V12Z"
                                                fill="#FF0000"
                                            />
                                        </svg>
                                        Not Interest
                                    </button>
                                    <button
                                        href="#"
                                        className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M19.9912 2.00201C19.8599 2.00194 19.7298 2.02775 19.6084 2.07798C19.4871 2.12821 19.3768 2.20187 19.2839 2.29474C19.1911 2.38761 19.1174 2.49788 19.0672 2.61924C19.017 2.7406 18.9911 2.87067 18.9912 3.00201V3.63873C18.1478 4.68444 17.0819 5.52893 15.871 6.11073C14.66 6.69254 13.3346 6.99702 11.9912 7.00201H5.99121C5.19583 7.00288 4.43327 7.31923 3.87085 7.88165C3.30843 8.44407 2.99208 9.20663 2.99121 10.002V12.002C2.99208 12.7974 3.30843 13.56 3.87085 14.1224C4.43327 14.6848 5.19583 15.0011 5.99121 15.002H6.475L4.07227 20.6084C4.00698 20.7605 3.98047 20.9264 3.99512 21.0912C4.00978 21.256 4.06514 21.4147 4.15624 21.5528C4.24734 21.691 4.37133 21.8043 4.51706 21.8827C4.6628 21.9611 4.82572 22.0021 4.99121 22.002H8.99121C9.18696 22.0021 9.37843 21.9447 9.54182 21.8369C9.7052 21.7291 9.83329 21.5756 9.91016 21.3956L12.6339 15.04C13.8646 15.1304 15.0636 15.472 16.157 16.0439C17.2505 16.6158 18.215 17.4058 18.9912 18.3651V19.002C18.9912 19.2672 19.0966 19.5216 19.2841 19.7091C19.4716 19.8967 19.726 20.002 19.9912 20.002C20.2564 20.002 20.5108 19.8967 20.6983 19.7091C20.8859 19.5216 20.9912 19.2672 20.9912 19.002V3.00201C20.9913 2.87067 20.9655 2.7406 20.9152 2.61924C20.865 2.49788 20.7914 2.38761 20.6985 2.29474C20.6056 2.20186 20.4953 2.12821 20.374 2.07798C20.2526 2.02775 20.1226 2.00194 19.9912 2.00201ZM5.99121 13.002C5.72605 13.0018 5.4718 12.8964 5.2843 12.7089C5.0968 12.5214 4.99139 12.2672 4.99121 12.002V10.002C4.99139 9.73685 5.09681 9.4826 5.2843 9.29511C5.4718 9.10761 5.72605 9.00219 5.99121 9.00201H6.99121V13.002H5.99121ZM8.33203 20.002H6.50781L8.65039 15.002H10.4746L8.33203 20.002ZM18.9912 15.5238C17.0195 13.8994 14.5459 13.0083 11.9912 13.002H8.99121V9.00196H11.9912C14.5459 8.99543 17.0195 8.10412 18.9912 6.47962V15.5238Z"
                                                fill="#FF0000"
                                            />
                                        </svg>
                                        Report
                                    </button>
                                </div>
                            </div>
                        </div>
                        <img
                            src={"storage/" + post.body}
                            alt=""
                            className="w-fit rounded-lg overflow-hidden"
                        />
                        <div className="flex py-1 items-center">
                            <div className="cursor-pointer hover:bg-gray-700 rounded-full w-fit p-2 h-fit">
                                {post.like.some(
                                    (like) => like.user_id === user.id
                                ) ? (
                                    <button
                                        onClick={() => handleunlike(post.id)}
                                        disabled={disabled}
                                    >
                                        <svg
                                            width="25"
                                            height="25"
                                            viewBox="0 0 29 28"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M4.13903 16.0803L14.7761 27.2405C15.1702 27.6539 15.8298 27.6539 16.2239 27.2405L26.861 16.0803C29.713 13.088 29.713 8.23653 26.861 5.24423C24.0089 2.25192 19.3849 2.25192 16.5328 5.24423L16.2239 5.56837C15.8298 5.98178 15.1702 5.98178 14.7761 5.56837L14.4672 5.24423C11.6151 2.25193 6.99107 2.25193 4.13903 5.24423C1.28699 8.23653 1.28699 13.088 4.13903 16.0803Z"
                                                fill="#FF3040"
                                            />
                                        </svg>
                                    </button>
                                ) : (
                                    <button
                                        onClick={() => handlelike(post.id)}
                                        disabled={disabled}
                                    >
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M3.58447 12.941L11.2674 21.2113C11.663 21.6372 12.337 21.6372 12.7326 21.2113L20.4155 12.941C22.5282 10.6669 22.5282 6.97976 20.4155 4.70561C18.3029 2.43146 14.8777 2.43146 12.765 4.70561L12.7326 4.74049C12.337 5.16635 11.663 5.16635 11.2674 4.74049L11.235 4.70561C9.12233 2.43146 5.69709 2.43146 3.58447 4.70561C1.47184 6.97976 1.47184 10.6669 3.58447 12.941Z"
                                                stroke="white"
                                                stroke-opacity="0.75"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </button>
                                )}
                            </div>
                            <Link
                                href={`/${post.user.name}/post/${post.id}`}
                                className="cursor-pointer flex items-center justify-center hover:bg-gray-700 rounded-full w-fit p-2 h-fit"
                            >
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <mask
                                        id="path-1-outside-1_0_308"
                                        maskUnits="userSpaceOnUse"
                                        x="1.99402"
                                        y="2"
                                        width="21"
                                        height="21"
                                        fill="black"
                                    >
                                        <rect
                                            fill="white"
                                            x="1.99402"
                                            y="2"
                                            width="21"
                                            height="21"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M17.9777 17.3318C19.2393 15.9168 20.006 14.0509 20.006 12.006C20.006 7.5844 16.4216 4 12 4C7.57842 4 3.99402 7.5844 3.99402 12.006C3.99402 16.4276 7.57842 20.012 12 20.012C13.521 20.012 14.9429 19.5878 16.1539 18.8514L18.4073 19.3347L17.9777 17.3318Z"
                                        />
                                    </mask>
                                    <path
                                        d="M17.9777 17.3318L16.4849 16.0008L15.8092 16.7586L16.0222 17.7513L17.9777 17.3318ZM16.1539 18.8514L16.5734 16.8958L15.795 16.7289L15.1148 17.1425L16.1539 18.8514ZM18.4073 19.3347L17.9878 21.2902L21.0114 21.9388L20.3628 18.9152L18.4073 19.3347ZM18.006 12.006C18.006 13.5414 17.4325 14.938 16.4849 16.0008L19.4705 18.6628C21.0461 16.8956 22.006 14.5605 22.006 12.006H18.006ZM12 6C15.317 6 18.006 8.68897 18.006 12.006H22.006C22.006 6.47983 17.5262 2 12 2V6ZM5.99402 12.006C5.99402 8.68897 8.68299 6 12 6V2C6.47385 2 1.99402 6.47983 1.99402 12.006H5.99402ZM12 18.012C8.68299 18.012 5.99402 15.323 5.99402 12.006H1.99402C1.99402 17.5321 6.47385 22.012 12 22.012V18.012ZM15.1148 17.1425C14.208 17.6939 13.1442 18.012 12 18.012V22.012C13.8978 22.012 15.6778 21.4817 17.1931 20.5602L15.1148 17.1425ZM15.7345 20.8069L17.9878 21.2902L18.8268 17.3792L16.5734 16.8958L15.7345 20.8069ZM20.3628 18.9152L19.9332 16.9123L16.0222 17.7513L16.4518 19.7542L20.3628 18.9152Z"
                                        fill="white"
                                        fill-opacity="0.75"
                                        mask="url(#path-1-outside-1_0_308)"
                                    />
                                </svg>
                            </Link>
                            <div>
                                <button
                                    className="cursor-pointer hover:bg-gray-700 rounded-full w-fit p-2 h-fit"
                                    onClick={() => dropdownpost(post.id)}
                                >
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M10 12L11.7281 19.7764C11.8261 20.2174 12.4125 20.3126 12.6449 19.9251L20.5457 6.75725C20.7456 6.42399 20.5056 6 20.1169 6H4.35163C3.88743 6 3.67378 6.57753 4.02623 6.87963L10 12ZM10 12L20 6.5"
                                            stroke="white"
                                            stroke-opacity="0.75"
                                            stroke-width="2"
                                        />
                                    </svg>
                                </button>
                                <div
                                    className="absolute z-10 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden hidden"
                                    id={`dropdown-post-${post.id}`}
                                >
                                    <button
                                        href="#"
                                        className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="currentColor"
                                            class="bi bi-link-45deg"
                                            viewBox="0 0 16 16"
                                        >
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                        </svg>
                                        Copy Link
                                    </button>
                                    <button
                                        href="#"
                                        className="flex w-full gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M18 14C17.4092 14.0039 16.8265 14.1387 16.294 14.3946C15.7615 14.6504 15.2922 15.0211 14.92 15.48L9.82 13.13C10.0598 12.3957 10.0598 11.6043 9.82 10.87L14.92 8.52C15.5216 9.24597 16.3603 9.73608 17.2881 9.90384C18.216 10.0716 19.1732 9.90623 19.9909 9.4369C20.8087 8.96758 21.4344 8.22448 21.7575 7.33874C22.0807 6.45301 22.0806 5.48158 21.7573 4.59591C21.434 3.71023 20.8081 2.96724 19.9903 2.49807C19.1725 2.02889 18.2152 1.86369 17.2874 2.03162C16.3597 2.19955 15.521 2.68982 14.9195 3.41589C14.318 4.14197 13.9924 5.05718 14 6C14.003 6.23823 14.0264 6.47577 14.07 6.71L8.79 9.14C8.22708 8.58958 7.51424 8.21752 6.7408 8.07043C5.96736 7.92334 5.16772 8.00777 4.44205 8.31313C3.71638 8.6185 3.09696 9.13122 2.6614 9.78706C2.22584 10.4429 1.9935 11.2127 1.9935 12C1.9935 12.7873 2.22584 13.5571 2.6614 14.2129C3.09696 14.8688 3.71638 15.3815 4.44205 15.6869C5.16772 15.9922 5.96736 16.0767 6.7408 15.9296C7.51424 15.7825 8.22708 15.4104 8.79 14.86L14.07 17.29C14.0264 17.5242 14.003 17.7618 14 18C14 18.7911 14.2346 19.5645 14.6741 20.2223C15.1136 20.8801 15.7384 21.3928 16.4693 21.6955C17.2002 21.9983 18.0044 22.0775 18.7804 21.9231C19.5563 21.7688 20.269 21.3878 20.8284 20.8284C21.3878 20.269 21.7688 19.5563 21.9231 18.7804C22.0775 18.0044 21.9983 17.2002 21.6955 16.4693C21.3928 15.7384 20.8801 15.1136 20.2223 14.6741C19.5645 14.2346 18.7911 14 18 14ZM18 4C18.3956 4 18.7822 4.1173 19.1111 4.33706C19.44 4.55682 19.6964 4.86918 19.8478 5.23463C19.9991 5.60009 20.0387 6.00222 19.9616 6.39018C19.8844 6.77814 19.6939 7.13451 19.4142 7.41421C19.1345 7.69392 18.7781 7.8844 18.3902 7.96157C18.0022 8.03874 17.6001 7.99913 17.2346 7.84776C16.8692 7.69638 16.5568 7.44004 16.3371 7.11114C16.1173 6.78224 16 6.39556 16 6C16 5.46957 16.2107 4.96086 16.5858 4.58579C16.9609 4.21071 17.4696 4 18 4ZM6 14C5.60443 14 5.21776 13.8827 4.88886 13.6629C4.55996 13.4432 4.30361 13.1308 4.15224 12.7654C4.00086 12.3999 3.96126 11.9978 4.03843 11.6098C4.1156 11.2219 4.30608 10.8655 4.58578 10.5858C4.86549 10.3061 5.22185 10.1156 5.60982 10.0384C5.99778 9.96126 6.39991 10.0009 6.76536 10.1522C7.13082 10.3036 7.44317 10.56 7.66294 10.8889C7.8827 11.2178 8 11.6044 8 12C8 12.5304 7.78928 13.0391 7.41421 13.4142C7.03914 13.7893 6.53043 14 6 14ZM18 20C17.6044 20 17.2178 19.8827 16.8889 19.6629C16.56 19.4432 16.3036 19.1308 16.1522 18.7654C16.0009 18.3999 15.9613 17.9978 16.0384 17.6098C16.1156 17.2219 16.3061 16.8655 16.5858 16.5858C16.8655 16.3061 17.2219 16.1156 17.6098 16.0384C17.9978 15.9613 18.3999 16.0009 18.7654 16.1522C19.1308 16.3036 19.4432 16.56 19.6629 16.8889C19.8827 17.2178 20 17.6044 20 18C20 18.5304 19.7893 19.0391 19.4142 19.4142C19.0391 19.7893 18.5304 20 18 20Z"
                                                fill="black"
                                            />
                                        </svg>
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>
                        <Link href={`/${post.user.name}/post/${post.id}`}>
                            <p className="text-sm text-white text-opacity-50">{post.comment.length} balasan</p>
                        </Link>
                    </div>
                </div>
            ))}
        </div>
    );
}

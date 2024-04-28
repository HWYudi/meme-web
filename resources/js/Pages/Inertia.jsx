import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/inertia-react";

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
        Inertia.post("/inertia", formData, {
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
        <div>
            {flash.message && (
                <div class="fixed top-0 right-0 p-3">{flash.message}</div>
            )}
            <div className="popup fixed z-40 inset-0 flex hidden items-center justify-center bg-black bg-opacity-80">
                <div className="bg-black rounded-lg p-2 px-5 w-full max-w-md ">

                    <div className="p-4 absolute top-0 right-0 cursor-pointer" onClick={togglePopup}>
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
                    className="flex py-4 border-y border-gray-600 gap-2 relative"
                >
                    <img
                        src={"storage/" + post.user.image}
                        alt=""
                        className="w-12 h-12 object-cover rounded-full"
                    />
                    <div>
                        <div className="mb-4">
                            <h1 className="font-semibold text-base text-[#DCDEE0]">
                                {post.user.name}
                            </h1>
                            <p className="text-[#E1E3E4]  text-sm">
                                {post.title}
                            </p>
                        </div>
                        <img
                            src={"storage/" + post.body}
                            alt=""
                            className="w-full rounded-lg overflow-hidden"
                        />
                        <div className="flex mt-4 mb-1 gap-1 items-center">
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
                                            width="25"
                                            height="25"
                                            viewBox="0 0 29 27"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M3.13903 14.0803L13.7761 25.2405C14.1702 25.6539 14.8298 25.6539 15.2239 25.2405L25.861 14.0803C28.713 11.088 28.713 6.23653 25.861 3.24423C23.0089 0.251924 18.3849 0.251924 15.5328 3.24423L15.2239 3.56837C14.8298 3.98178 14.1702 3.98178 13.7761 3.56837L13.4672 3.24423C10.6151 0.251925 5.99107 0.251925 3.13903 3.24423C0.28699 6.23653 0.28699 11.088 3.13903 14.0803Z"
                                                stroke="white"
                                                strokeWidth="2"
                                            />
                                        </svg>
                                    </button>
                                )}
                            </div>
                            <Link
                                   href={`/${post.user.name}/post/${post.id}`}
                             className="cursor-pointer flex items-center justify-center hover:bg-gray-700 rounded-full w-fit p-2 h-fit">
                                <svg
                                    width="25"
                                    height="25"
                                    viewBox="0 0 31 31"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <mask
                                        id="path-1-outside-1_236_149"
                                        maskUnits="userSpaceOnUse"
                                        x="1.99414"
                                        y="2"
                                        width="29"
                                        height="29"
                                        fill="black"
                                    >
                                        <rect
                                            fill="white"
                                            x="1.99414"
                                            y="2"
                                            width="29"
                                            height="29"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M25.8272 24.8154C27.7971 22.6061 28.9941 19.6929 28.9941 16.5C28.9941 9.59644 23.3977 4 16.4941 4C9.59058 4 3.99414 9.59644 3.99414 16.5C3.99414 23.4036 9.59058 29 16.4941 29C18.8689 29 21.0889 28.3378 22.9797 27.188L26.498 27.9427L25.8272 24.8154Z"
                                        />
                                    </mask>
                                    <path
                                        d="M25.8272 24.8154L24.3344 23.4845L23.6588 24.2423L23.8717 25.2349L25.8272 24.8154ZM22.9797 27.188L23.3992 25.2325L22.6208 25.0655L21.9405 25.4791L22.9797 27.188ZM26.498 27.9427L26.0786 29.8982L29.1021 30.5468L28.4536 27.5232L26.498 27.9427ZM26.9941 16.5C26.9941 19.1833 25.9902 21.6273 24.3344 23.4845L27.32 26.1464C29.6039 23.5849 30.9941 20.2024 30.9941 16.5H26.9941ZM16.4941 6C22.2931 6 26.9941 10.701 26.9941 16.5H30.9941C30.9941 8.49187 24.5023 2 16.4941 2V6ZM5.99414 16.5C5.99414 10.701 10.6952 6 16.4941 6V2C8.48601 2 1.99414 8.49187 1.99414 16.5H5.99414ZM16.4941 27C10.6952 27 5.99414 22.299 5.99414 16.5H1.99414C1.99414 24.5081 8.48601 31 16.4941 31V27ZM21.9405 25.4791C20.354 26.4439 18.4921 27 16.4941 27V31C19.2456 31 21.8238 30.2317 24.0189 28.8968L21.9405 25.4791ZM22.5602 29.1435L26.0786 29.8982L26.9175 25.9872L23.3992 25.2325L22.5602 29.1435ZM28.4536 27.5232L27.7827 24.396L23.8717 25.2349L24.5425 28.3622L28.4536 27.5232Z"
                                        fill="white"
                                        mask="url(#path-1-outside-1_236_149)"
                                    />
                                </svg>
                            </Link>

                            <div className="cursor-pointer hover:bg-gray-700 rounded-full w-fit p-2 h-fit">
                                <svg
                                    width="25"
                                    height="27"
                                    viewBox="0 0 29 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12.7222 14.3333L15.2281 25.6097C15.3261 26.0508 15.9125 26.1459 16.1449 25.7585L27.5457 6.75725C27.7456 6.42399 27.5056 6 27.1169 6H4.35163C3.88743 6 3.67378 6.57753 4.02623 6.87963L12.7222 14.3333ZM12.7222 14.3333L26.6111 6.69444"
                                        stroke="white"
                                        stroke-width="2"
                                    />
                                </svg>
                            </div>
                        </div>
                        <p>{post.comment.length} balasan</p>
                    </div>
                    <div className="absolute top-0 flex items-center justify-center right-0 w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-10">
                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 68 17"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M8.94595 16.9279C13.5384 16.9279 17.2613 13.205 17.2613 8.61263C17.2613 4.0202 13.5384 0.29731 8.94595 0.29731C4.35352 0.29731 0.63063 4.0202 0.63063 8.61263C0.63063 13.205 4.35352 16.9279 8.94595 16.9279ZM42.2072 8.61263C42.2072 13.205 38.4843 16.9279 33.8919 16.9279C29.2995 16.9279 25.5766 13.205 25.5766 8.61263C25.5766 4.0202 29.2995 0.29731 33.8919 0.29731C38.4843 0.29731 42.2072 4.0202 42.2072 8.61263ZM67.1532 8.61263C67.1532 13.205 63.4303 16.9279 58.8378 16.9279C54.2454 16.9279 50.5225 13.205 50.5225 8.61263C50.5225 4.0202 54.2454 0.29731 58.8378 0.29731C63.4303 0.29731 67.1532 4.0202 67.1532 8.61263Z"
                                fill="white"
                            />
                        </svg>
                    </div>
                </div>
            ))}
        </div>
    );
}

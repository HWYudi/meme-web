import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";

export default function home({ posts, user }) {
    const [Title, setTitle] = useState("");
    const [Body, setBody] = useState(null);
    const [disabled , setdisabled] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = {
            title: Title,
            body: Body,
        };
        Inertia.post("/inertia", formData);
    };

    const handlelike = (id) => {
        Inertia.post("/posts/" + id + "/like" , {} , {onProgress: () => setdisabled(true),onStart: () => setdisabled(true),onFinish: () => setdisabled(false),preserveScroll: true,});
    };

        const handleunlike = (id) => {
        Inertia.delete("/posts/" + id + "/unlike", {onProgress: () => setdisabled(true) ,onStart: () => setdisabled(true),onFinish: () => setdisabled(false),preserveScroll: true});
    }

    console.log(posts);

    return (
        <div>
            <div className="popup fixed z-40 inset-0 flex items-center hidden justify-center bg-black bg-opacity-80">
                <div className="bg-black rounded-lg p-2 px-5 w-full max-w-md relative">
                    <span
                        onClick={togglePopup}
                        className="text-white cursor-pointer"
                    >
                        &times;
                    </span>
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
                </div>
            </div>

                {posts.map((post) => (
                    <div key={post.id}>
                        <div className="flex gap-2 relative">
                            <img
                                src={"storage/" + post.user.image}
                                alt=""
                                className="w-12 h-12 object-cover rounded-full"
                            />
                            <div>
                                <h1>{post.user.name}</h1>
                                <p>{post.title}</p>
                                <img
                                    src={"storage/" + post.body}
                                    alt=""
                                    className="w-full"
                                />
                                <div className="flex gap-5 items-center">
                                    <div className="cursor-pointer hover:bg-gray-700 w-fit h-fit">
                                        {post.like.some(
                                            (like) => like.user_id === user.id
                                        ) ? (
                                            <button onClick={() => handleunlike(post.id)} disabled={disabled}>
                                            <svg
                                                width="29"
                                                height="28"
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
                                            <button onClick={() => handlelike(post.id)} disabled={disabled}>
                                            <svg
                                                width="29"
                                                height="27"
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

                                    <svg
                                        width="31"
                                        height="31"
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

                                    <svg
                                        width="29"
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
                                <p>{post.comment.length} balasan</p>
                            </div>
                            <div className="absolute top-0 right-0">
                                <h1>action</h1>
                            </div>
                        </div>
                    </div>
                ))}
        </div>
    );
}

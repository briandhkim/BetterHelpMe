import { Link } from '@inertiajs/react';
import React from 'react';

const LinkButtonSecondary = ({
	children,
	href,
	type = 'button',
	as = 'button',
}) => {
	return (
		<Link
			href={href}
			as={as}
			type={type}
			className='inline-flex items-center gap-x-1.5 rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50'
		>
			{children}
		</Link>
	);
};

export default LinkButtonSecondary;
